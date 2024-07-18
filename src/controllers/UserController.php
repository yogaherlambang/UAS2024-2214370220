<?php

namespace App\Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Views\PhpRenderer;

class UserController
{

    /**
     * @var Slim\Views\PhpRenderer
     */
    private $view;

    public function __construct(PhpRenderer $view)
    {
        $this->view = $view;
    }

    public function index(Request $request, Response $response)
    {
        if(\App\Helper\Session::get('auth')->role !== 'admin' ){
            return $response->withRedirect('/dashboard');
        }

        $users = \App\Model\User::all();
        return $this->view->render($response, 'users.php', ['title' => 'Users', 'users' => $users]);
    }

    public function createUserForm(Request $request, Response $response)
    {
        return $this->view->render($response, 'add-user.php', ['title' => 'create user']);
    }

    public function createUser(Request $request, Response $response)
    {
        $body = $request->getParsedBody();

        $errors = $this->validateUser($body);

        if ($errors) {
            return $this->view->render(
                $response,
                'add-user.php',
                [
                    'title' => 'Add user',

                    'errors' => (object) $errors,
                ]
            );
        }
        $id = \Ramsey\Uuid\Uuid::uuid4();

        $input = [

            $password = password_hash($body['password'], PASSWORD_DEFAULT),
            'id' => $id,
            'name' => $body['name'],
            'username' => $body['username'],
            'password' => $password,
            'email' => $body['email'],
        ];
        $user = \App\Model\User::create($input);

        $mailer = new \App\Library\Mailer();
        $mailer->subject = 'Login Credentials';
        $mailer->body = \App\Library\WelcomeMailTemplate::create($user->email, $body['password']);
        $mailer->recipent = $user->email;
        $mailer->recipent_name = $user->name;

        if ($mailer->send()) {
            return $this->view->render(
                $response,
                "add-user.php",
                [
                    "title" => "create user",
                    'msg' => 'User created successfully',
                ]
            );
        } else {
            return $this->view->render(
                $response,
                "add-user.php",
                [
                    "title" => "create user",
                    'error' => 'Unable create user',
                ]
            );
        }
    }


    public function deleteUser(Request $request, Response $response, $args)
    {
        $id = $args['id'];

        if (!$id) {
            return $this->view->render($response, '404.php', ['title' => '404 not found']);
        }

        if (\App\Model\User::find($id)->delete()) {

            $users = \App\Model\user::all();

            return $this->view->render(
                $response,
                'users.php',
                [
                    'title' => 'users',
                    'users' => $users,
                    'msg' => 'user deleted',
                ]
            );
        } else {
            return $this->view->render(
                $response,
                'users.php',
                [
                    'title' => 'Users',
                    'error' => 'Failed to delete user',
                ]
            );
        }
    }

    public function profile(Request $request, Response $response, $args)
    {
        $username = $args['username'];

        $user = \App\Model\User::where('username', $username)->first();
        //print_r($user);die;

        $parsedAbout = \Parsedown::instance()
            ->setBreaksEnabled(false)
            ->text($user->about);
        //$user->about = $parsedAbout;

        return $this->view->render($response, 'profile.php', ['title' => $user->name, 'user' => $user]);
    }

    public function update(Request $request, Response $response, $args)
    {
        $username = $args['username'];

        if (\App\Helper\Session::get('auth')->username !== $username && \App\Helper\Session::get('auth')->role !== 'admin') {
            return $response->withRedirect('/user/' . $username);
        }

        $user = \App\Model\User::where('username', $username)->first();
        return $this->view->render($response, 'update-profile.php', ['title' => 'Edit profile', 'user' => $user]);
    }

    public function changePass(Request $request, Response $response, $args)
    {
        $username = $args['username'];

        if (\App\Helper\Session::get('auth')->username !== $username && \App\Helper\Session::get('auth')->role !== 'admin') {
            return $response->withRedirect('/user/' . $username);
        }

        $user = \App\Model\User::where('username', $username)->first();

        return $this->view->render($response, 'change-password.php', ['title' => 'Change password', 'user' => $user]);
    }

    public function updateProfilePicture(Request $request, Response $response)
    {
        $files = $request->getUploadedFiles();
        $body = $request->getParsedBody();

        if (\App\Helper\Session::get('auth')->id !== $body['user_id'] && \App\Helper\Session::get('auth')->role !== 'admin') {
            return $response->withJson([
                'msg' => 'Unauthorised'
            ])->withStatus(401);
        }

        $file  = $files['file'];

        $validFiles = ['jpg', 'png', 'jpeg'];
        $ext = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);

        if (!in_array($ext, $validFiles)) {
            return $response->withJson([
                'msg' => 'Please select a valid file (Only jpg, png, jpeg)'
            ])->withStatus(415);
        }

        $user = \App\Model\User::find($body['user_id']);

        $oldAvatar = $user->avatar;

        $filename = \App\Library\UploadedFile::move('./images/avatar', $file);

        unlink('./images/avatar/' . $oldAvatar);

        $host = $request->getUri()->getBaseUrl();

        $imgUrl = $host . '/images/avatar/' . $filename;

        $user->update(['avatar' => $imgUrl]);

        return $response->withJson([
            'imgUrl' => $imgUrl
        ])->withStatus(200);
    }

    public function updateProfile(Request $request, Response $response, $args)
    {
        $body = $request->getParsedBody();
        $errors = $this->validateData($body);

        if ($errors) {
            return $this->view->render(
                $response,
                'update-profile.php',
                [
                    'title' => 'Edit profile',
                    'user' => (object) $body,
                    'errors' => (object) $errors,
                ]
            );
        }

        $input = [
            'name' => $body['name'],
            'email' => $body['email'],
            'work' => $body['work'],
            'facebook' => $body['facebook'],
            'linkedin' => $body['linkedin'],
            'twitter' => $body['twitter'],
            'github' => $body['github'],
            'website' => $body['website'],
            'about' => $body['about'],

        ];

        if (\App\Model\User::find($body['id'])->update($input)) {

            $updatedUser = \App\Model\User::find($body['id']);

            \App\Helper\Session::set('auth', $updatedUser);

            return $this->view->render(
                $response,
                'update-profile.php',
                [
                    'title' => 'Edit profile',
                    'user' => $updatedUser,
                    'msg' => 'Profile Updated',

                ]
            );
        } else {
            return $this->view->render(
                $response,
                'update-profile.php',
                [
                    'title' => 'Edit profile',
                    'error' => 'Failed to update profile',
                ]
            );
        }
    }

    public function passwordUpdate(Request $request, Response $response, $args)
    {
        $body = $request->getParsedBody();

        $errors = $this->validatePassword($body);

        if ($errors) {
            return $this->view->render(
                $response,
                'change-password.php',
                [
                    'title' => 'Change password',
                    'input' => (object) $body,
                    'errors' => (object) $errors,
                ]
            );
        }

        $user = \App\Model\User::find($body['id']);

        if (!password_verify($body['password'], $user->password)) {
            return $this->view->render(
                $response,
                'change-password.php',
                [
                    'title' => 'Change password',
                    'input' => (object) $body,
                    'error' => 'You have given a wrong current password',
                ]
            );
        }

        $new_password = password_hash($body['new-password'], PASSWORD_DEFAULT);

        $input = [
            'password' => $new_password,
        ];

        if (!\App\Model\User::find($body['id'])->update($input)) {
            return $this->view->render(
                $response,
                'change-password.php',
                [
                    'title' => 'Change password',
                    'input' => (object) $body,
                    'error' => 'Failed to update password',
                ]
            );
        }

        return $this->view->render(
            $response,
            'change-password.php',
            [
                'title' => 'Change password',
                'msg' => 'Password Updated',

            ]
        );
    }

    private function validateUser($body)
    {
        $errors = [
            'name' => '',
            'username' => '',
            'password' => '',
            'email' => '',

        ];
        $hasError = false;

        if (strlen($body['name']) < 1) {
            $hasError = true;
            $errors['name'] = 'Please enter the name';
        }

        if (strlen($body['name']) > 150) {
            $hasError = true;
            $errors['name'] = 'Name should not be greater than 150 character';
        }

        if (strlen($body['username']) < 1) {
            $hasError = true;
            $errors['username'] = 'Please enter the username';
        }

        if (strlen($body['password']) < 1) {
            $hasError = true;
            $errors['password'] = 'Please enter the password';
        }

        if (strlen($body['password']) < 8) {
            $hasError = true;
            $errors['password'] = 'Password must be atleast 8 characters';
        }

        if (strlen($body['email']) < 1) {
            $hasError = true;
            $errors['email'] = 'Please enter the email';
        }

        if (!filter_var($body['email'], FILTER_VALIDATE_EMAIL)) {
            $hasError = true;
            $errors['email'] = 'Please enter valid email';
        }

        if ($hasError) {
            return $errors;
        } else {
            return false;
        }
    }

    private function validateData($body)
    {
        $errors = [
            'name' => '',
            'email' => '',
            'facebook' => '',
            'linkedin' => '',
            'twitter' => '',
            'github' => '',
            'website' => '',
            'about' => '',
        ];

        $hasError = false;

        if (strlen($body['name']) < 1) {
            $hasError = true;
            $errors['name'] = 'Please enter your name';
        }

        if (!preg_match("/^[a-zA-Z ]*$/", $body['name'])) {
            $hasError = true;
            $errors['name'] = 'Only letters and white space allowed';
        }

        if (strlen($body['email']) < 1) {
            $hasError = true;
            $errors['email'] = 'Please enter email';
        }

        if (!filter_var($body['email'], FILTER_VALIDATE_EMAIL)) {
            $hasError = true;
            $errors['email'] = 'Please enter valid email';
        }

        if (strlen($body['facebook']) > 0) {
            if (!filter_var($body['facebook'], FILTER_VALIDATE_URL)) {
                $hasError = true;
                $errors['facebook'] = 'Please enter valid facebook url';
            }
        }

        if (strlen($body['linkedin']) > 0) {
            if (!filter_var($body['linkedin'], FILTER_VALIDATE_URL)) {
                $hasError = true;
                $errors['linkedin'] = 'Please enter valid linkedin url';
            }
        }

        if (strlen($body['twitter']) > 0) {
            if (!filter_var($body['twitter'], FILTER_VALIDATE_URL)) {
                $hasError = true;
                $errors['twitter'] = 'Please enter valid twitter url';
            }
        }

        if (strlen($body['github']) > 0) {
            if (!filter_var($body['github'], FILTER_VALIDATE_URL)) {
                $hasError = true;
                $errors['github'] = 'Please enter valid github url';
            }
        }

        if (strlen($body['website']) > 0) {
            if (!filter_var($body['website'], FILTER_VALIDATE_URL)) {
                $hasError = true;
                $errors['website'] = 'Please enter valid website url';
            }
        }

        if ($hasError) {
            return $errors;
        } else {
            return false;
        }
    }

    private function validatePassword($body)
    {
        $errors = [
            'password' => '',
            'new_password' => '',
            'confirm_password' => '',
        ];

        $hasError = false;

        if (strlen($body['password']) < 1) {
            $hasError = true;
            $errors['password'] = 'Please enter your current password';
        }
        if (strlen($body['new_password']) < 1) {
            $hasError = true;
            $errors['new_password'] = 'Please enter your new password';
        }
        if (strlen($body['new_password']) < 8) {
            $hasError = true;
            $errors['new_password'] = 'New password must be atleast 8 characters';
        }
        if (strlen($body['confirm_password']) < 1) {
            $hasError = true;
            $errors['confirm_password'] = 'Please re-enter the new password';
        }

        if ($body['password'] == $body['new_password']) {
            $hasError = true;
            $errors['new_password'] = 'New password cannot be same with current password';
        }

        if ($body['new_password'] != $body['confirm_password']) {
            $hasError = true;
            $errors['confirm_password'] = 'Password doesnot match';
        }

        if ($hasError) {
            return $errors;
        } else {
            return false;
        }
    }
}
