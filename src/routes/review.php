<?php
$app->get('/review/{id}/{title}', '\App\Controller\ReviewController:formHandler');

$app->post('/review/create', '\App\Controller\ReviewController:createHandler');

$app->get('/review/edit/{id}/{post}', '\App\Controller\ReviewController:editFromHandler');

$app->post('/review/edit', '\App\Controller\ReviewController:editHandler');

$app->get('/review/delete/{id}/{post}', '\App\Controller\ReviewController:deleteHandler');