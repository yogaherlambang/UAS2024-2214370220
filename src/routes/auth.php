<?php
/**
 * TODO: Route root need to move in separate file maybe
 */
$app->get('/', '\App\Controller\AuthController:loginFrom');

$app->post('/', '\App\Controller\AuthController:loginHandler');

$app->get('/auth/forgotpassword', '\App\Controller\AuthController:forgotPasswordFrom');

$app->post('/auth/forgotpassword', '\App\Controller\AuthController:forgotPassword');

$app->get('/auth/logout', '\App\Controller\AuthController:logoutHandler');

$app->get('/auth/passwordreset/{user}/{token}', '\App\Controller\AuthController:passwordResetTokenVerify');

$app->post('/auth/passwordreset', '\App\Controller\AuthController:passwordReset');
