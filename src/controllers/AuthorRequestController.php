<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;

class AuthorRequestController
{
    /**
     * @var Slim\Views\PhpRenderer
     */
    private $view = null;

    public function __construct(PhpRenderer $view)
    {
        $this->view = $view;
    }

    public function all(Request $request, Response $response, $args)
    {
        $authorRequests = \App\Model\AuthorRequest::all();

        return $this->view->render($response, 'author-request.php', ['title' => 'Author Request', 'requests' => $authorRequests]);
    }
}
