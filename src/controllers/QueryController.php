<?php

namespace App\Controller;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class QueryController
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
        $allQuery = \App\Model\Query::all();

        return $this->view->render($response, 'query.php', ['title' => 'Query', 'queries' => $allQuery]);
    }
}
