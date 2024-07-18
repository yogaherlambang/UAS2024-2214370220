<?php
$container['settings'] = [
    'displayErrorDetails' => true,

    'logger' => [
        'name' => 'slim-app',
        'level' => Monolog\Logger::DEBUG,
        'path' => '../logs/app.log',
    ],
];

$container['renderer'] = function(){
    $view = new Slim\Views\PhpRenderer("./templates");
    $view->setLayout("layout.php");
    return $view;
};
