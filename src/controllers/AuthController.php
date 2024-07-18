<?php

namespace App\Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Views\PhpRenderer;
use stdClass;

class AuthController
{
    /**
     * @var Slim\Views\PhpRenderer
     */
    private $view;

    public function __construct(PhpRenderer $view)
    {
        $this->view = $view;
        $this->view->setLayout(null);
    }
    /**
     * TODO: move to separate controoler maybe
     */
    public function loginFrom(Request $request, Response $response)
    {
        if (\App\Helper\Session::isCookie('auth') || \App\Helper\Session::isSession('auth')) {
            return $response->withRedirect('/dashboard');
        }

        $this->view->render($response, "index.php", ["title" => "Synchlab blog"]);
    }

    public function loginHandler(Request $request, Response $response)
    {
        $body = $request->getParsedBody();

        $errors = [];
        $hasError = false;

        $username = $body['username'];
        $password = $body['password'];

        if (strlen($username) < 1) {
            $errors['username'] = 'Enter username or email';
            $hasError = true;
        }

        if (strlen($password) < 1) {
            $errors['password'] = 'Enter password';
            $hasError = true;
        }

        if ($hasError) {
            return $this->view->render($response, 'index.php', ['title' => 'Synchlab blog', 'errors' => (object) $errors]);
        }

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $user = \App\Model\User::where('email', $username)->first();
        } else {
            $user = \App\Model\User::where('username', $username)->first();
        }

        if (password_verify($password, $user->password)) {

            \App\Helper\Session::set('auth', $user);

            if (isset($body['remember'])) {
                $payload = [
                    'user_id' => $user->id,
                    'password' => $password,
                    'iat' => time()
                ];
                $jwt = \Firebase\JWT\JWT::encode($payload, getenv('ENC_KEY'), 'HS256');
                \App\Helper\Session::setCookie('auth', $jwt);
            }

            return $response->withRedirect('/dashboard');
        }

        return $this->view->render($response, 'index.php', ['title' => 'Synchlab blog', 'error' => 'Wrong username or password']);
    }

    public function forgotPasswordFrom(Request $request, Response $response)
    {
        $this->view->render($response, "forgot-password.php", ["title" => "Request reset password link"]);
    }

    public function forgotPassword(Request $request, Response $response)
    {
        $body = $request->getParsedBody();
        $email = $body['email'];

        $errors = new stdClass;

        if (strlen($email) < 1) {
            $errors->email = 'Plaese enter your email';
            return $this->view->render(
                $response,
                "forgot-password.php",
                [
                    "title" => "Request reset password link",
                    'errors' => $errors
                ]
            );
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors->email = 'Please enter valid email';
            return $this->view->render(
                $response,
                "forgot-password.php",
                [
                    "title" => "Request reset password link",
                    'errors' => $errors
                ]
            );
        }

        $user = \App\Model\User::where('email', $email)->first();

        if (!$user) {
            return $this->view->render(
                $response,
                "forgot-password.php",
                [
                    "title" => "Request reset password link",
                    'error' => 'We could not find a user with your email address'
                ]
            );
        }

        $uuid = \Ramsey\Uuid\Uuid::uuid4();
        $iv = \App\Library\AES256ofbIV::get();

        $ciphertext = \App\Library\OpenSSL::encript($uuid, getenv('ENC_KEY'), $iv);
        //$original_plaintext =  \App\Library\OpenSSL::decript($ciphertext, getenv('ENC_KEY'), $iv);
        //dnd($original_plaintext);
        $resetRequest = [
            'id' => \Ramsey\Uuid\Uuid::uuid4(),
            'user_id' => $user->id,
            'token' => $uuid,
            'iv' =>  bin2hex($iv)
        ];

        \App\Model\PasswordRequest::create($resetRequest);


        $host = getenv('HOST') ? getenv('HOST') : $request->getUri()->getBaseUrl();

        $resetUri = $host . '/auth/passwordreset/' . $user->id . '/' . base64_encode($ciphertext);

        $mailer = new \App\Library\Mailer();
        $mailer->subject = 'Password reset';
        $mailer->body = \App\Library\PasswordResetTemplate::create($resetUri);
        $mailer->recipent = $email;
        $mailer->recipent_name = $user->name;

        if ($mailer->send()) {
            return $this->view->render(
                $response,
                "forgot-password.php",
                [
                    "title" => "Request reset password link",
                    'msg' => 'We have sent you the instruction for reseting  your password'
                ]
            );
        } else {
            return $this->view->render(
                $response,
                "forgot-password.php",
                [
                    "title" => "Request reset password link",
                    'error' => 'We could not sent you reset link at this moment, please try later'
                ]
            );
        }
    }

    public function passwordResetTokenVerify(Request $request, Response $response, $args)
    {
        $userId = $args['user'];
        $requestToken = base64_decode($args['token']);

        $resetRequest = \App\Model\PasswordRequest::where('created_at', '>=', \Carbon\Carbon::now()->subDay())->latest()->first();
        $iv = hex2bin($resetRequest->iv);

        $decreptedToken = \App\Library\OpenSSL::decript($requestToken, getenv('ENC_KEY'), $iv);

        if ($decreptedToken !== $resetRequest->token) {
            return $this->view->render($response, 'invalid-reset-request.php', ['title' => 'Invalid password reset request']);
        }

        \App\Helper\Session::set('password-reset-token', base64_encode($requestToken));
        \App\Helper\Session::set('password-reset-user_id', $userId);
        return $this->view->render($response, 'reset-password.php', ['title' => 'Reset password', 'token' => base64_encode($requestToken)]);
    }

    public function passwordReset(Request $request, Response $response)
    {
        $body = $request->getParsedBody();

        $errors = new stdClass;
        $errors->password = '';
        $errors->confirm_password = '';

        $hasError = false;

        if (strlen($body['password']) < 1) {
            $hasError = true;
            $errors->password = 'Enter new password';
        }

        if (strlen($body['password']) < 8) {
            $hasError = true;
            $errors->password = 'Password must be al least 8 character';
        }

        if ($body['password'] !== $body['confirm_password']) {
            $hasError = true;
            $errors->confirm_password = 'Password does not match';
        }

        if ($hasError) {
            return $this->view->render($response, 'reset-password.php', ['title' => 'Reset password', 'errors' => $errors, 'token' => base64_encode($body['token'])]);
        }

        $password = password_hash($body['password'], PASSWORD_DEFAULT);
        $user_id = \App\Helper\Session::get('password-reset-user_id');

        $resetRequest = \App\Model\PasswordRequest::where('user_id', $user_id)->latest()->first();

        $iv = hex2bin($resetRequest->iv);
        $decreptedToken = \App\Library\OpenSSL::decript(base64_decode($body['token']), getenv('ENC_KEY'), $iv);

        if ($resetRequest->token !== $decreptedToken) {
            return $this->view->render($response, 'reset-password.php', ['title' => 'Reset password', 'error' => 'Invalid password reset token']);
        }

        if (\App\Model\User::find($user_id)->update(['password' => $password])) {
            return $this->view->render($response, 'reset-password.php', ['title' => 'Reset password', 'msg' => 'Password has been reset, please login']);
            \App\Helper\Session::kill('password-reset-user_id');
        } else {
            return $this->view->render($response, 'reset-password.php', ['title' => 'Reset password', 'error' => 'Failed to reset password, try atain later']);
        }
    }


    public function logoutHandler(Request $request, Response $response)
    {

        \App\Helper\Session::killAll();
        \App\Helper\Session::killCookie('auth');
        return $response->withRedirect('/');
    }
}
