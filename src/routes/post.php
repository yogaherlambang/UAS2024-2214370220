<?php
$app->get('/posts', '\App\Controller\PostController:index');

$app->get('/myposts', '\App\Controller\PostController:myPosts');

$app->get('/post/{id}/{title}', '\App\Controller\PostController:view');

$app->get('/post/create', '\App\Controller\PostController:createFormHandler');

$app->post('/post/create', '\App\Controller\PostController:createHandler');

$app->get('/post/edit/{id}/{title}', '\App\Controller\PostController:editFormHandler');

$app->post('/post/edit', '\App\Controller\PostController:editHandler');

$app->get('/post/delete/{id}/{title}', '\App\Controller\PostController:deleteHandler');

$app->get('/post/block/{id}/{title}', '\App\Controller\PostController:blockHandler');

$app->get('/post/approve/{id}/{title}', '\App\Controller\PostController:approveHandler');