<?php

namespace App\Middleware;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class Auth
{
    /**
     * Checks if a user is logged in 
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response, $next)
    {
        $uri = $request->getUri();
        $path = $uri->getPath();

        $pathArr = explode('/', $path);

        if ($pathArr[1] === 'auth' && $pathArr[2] === 'passwordreset') {
            $path = "/auth/passwordreset";
        }

        $publicRoute = ["/", "/auth/passwordreset", "/auth/forgotpassword"];

        if (
            !\App\Helper\Session::isSession('auth') &&
            !\App\Helper\Session::isCookie('auth') &&
            !in_array($path, $publicRoute)
        ) {
            return $response->withRedirect('/');
        }

        if (\App\Helper\Session::isCookie('auth') && !\App\Helper\Session::isSession('auth')) {
            $jwt = \App\Helper\Session::getCookie('auth');

            $decoded  = \Firebase\JWT\JWT::decode($jwt, getenv('ENC_KEY'), ['HS256']);

            $user = \App\Model\User::find($decoded->user_id);

            if (!password_verify($decoded->password, $user->password)) {
                return $response->withRedirect('/');
            }

            \App\Helper\Session::set('auth', $user);
        }

        return  $next($request, $response);
    }
}
