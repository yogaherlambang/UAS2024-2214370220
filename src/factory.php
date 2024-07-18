<?php

$container = $app->getContainer();

$container['\App\Controller\PostController'] = function ($c) {
    $view = $c->get('renderer');

    return new \App\Controller\PostController($view);
};

$container['\App\Controller\ReviewController'] = function ($c) {
    $view = $c->get('renderer');

    return new \App\Controller\ReviewController($view);
};

$container['\App\Controller\AuthController'] = function ($c) {
    $view = $c->get('renderer');

    return new \App\Controller\AuthController($view);
};

$container['\App\Controller\UserController'] = function ($c) {
    $view = $c->get('renderer');

    return new \App\Controller\UserController($view);
};

$container['\App\Controller\AuthorRequestController'] = function ($c) {
    $view = $c->get('renderer');

    return new \App\Controller\AuthorRequestController($view);
};

$container['\App\Controller\QueryController'] = function ($c) {
    $view = $c->get('renderer');

    return new \App\Controller\QueryController($view);
};
