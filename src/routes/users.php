<?php

$app->get('/users', '\App\Controller\UserController:index');

$app->get('/user/create', '\App\Controller\UserController:createUserForm');

$app->post('/user/create', '\App\Controller\UserController:createUser');

$app->get('/user/{username}', '\App\Controller\UserController:profile');

$app->get('/user/update/{username}', '\App\Controller\UserController:update');

$app->post('/user/update', '\App\Controller\UserController:updateProfile');

$app->get('/user/changepass/{username}', '\App\Controller\UserController:changePass');

$app->post('/user/changepass', '\App\Controller\UserController:passwordUpdate');

$app->post('/user/update-profile-picture', '\App\Controller\UserController:updateProfilePicture');

$app->get('/user/delete/{id}', '\App\Controller\UserController:deleteUser');
