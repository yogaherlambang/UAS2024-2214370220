<?php

namespace App\Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Views\PhpRenderer;
use \App\Helper\Formater;

class ReviewController
{
    /**
     * @var Slim\Views\PhpRenderer
     */
    private $view;

    public function __construct(PhpRenderer $view)
    {
        $this->view = $view;
    }

    public function formHandler(Request $request, Response $response, $args)
    {
        $id = $args['id'];
        $titile = $args['title'];

        if (!$id || !$titile) {
            return $this->view->render($response, '404.php', ['title' => '404 not found']);
        }

        return $this->view->render($response, 'review.php', ['title' => 'Review', 'post_id' => $id]);
    }

    public function createHandler(Request $request, Response $response)
    {
        $body = $request->getParsedBody();

        if (!$body['body']) {
            return $this->view->render(
                $response,
                'review.php',
                [
                    'title' => 'Review',
                    'errors' => (object) ['body' => 'Please write your review']
                ]
            );
        }

        $input = [
            'id' => \Ramsey\Uuid\Uuid::uuid4(),
            'post_id' => $body['post_id'],
            'user_id' => \App\Helper\Session::get('auth')->id,
            'body' => $body['body']
        ];

        if (
            \App\Model\Review::create($input) &&
            \App\Model\Post::find($body['post_id'])->update(['status' => 'blocked'])
        ) {
            $post = \App\Model\Post::find($body['post_id']);
            return $response->withRedirect('/post/' . $post->id . '/' . Formater::space2dash($post->title));
        } else {
            return $this->view->render(
                $response,
                'review.php',
                [
                    'title' => 'Review',
                    'erorr' => 'Failed to post review'
                ]
            );
        }
    }

    public function editFromHandler(Request $request, Response $response, $args)
    {
        $id = $args['id'];

        if (!$id) {
            return $this->view->render($response, '404.php', ['title' => '404 not found']);
        }

        $review = \App\Model\Review::find($id);
       
        if (!$review) {
            return $this->view->render($response, '404.php', ['title' => '404 not found']);
        }

        return $this->view->render($response, 'edit-review.php', ['title' => 'Edit review', 'review' => $review]);
    }

    public function editHandler(Request $request, Response $response)
    {
        $body = $request->getParsedBody();

        if (!$body['body']) {
            return $this->view->render(
                $response,
                'review.php',
                [
                    'title' => 'Review',
                    'errors' => (object) ['body' => 'Please write your review']
                ]
            );
        }

        if(\App\Model\Review::find($body['id'])->update(['body' => $body['body']])){

            $updatedReview = \App\Model\Review::find($body['id']);
            return $this->view->render(
                $response,
                'edit-review.php',
                [
                    'title' => 'Edit review',
                    'msg' => 'Review updated',
                    'review' => $updatedReview
                ]
            );
        } else {
            return $this->view->render(
                $response,
                'edit-review.php',
                [
                    'title' => 'Edit review',
                    'erorr' => 'Failed to update review'
                ]
            );
        }
    }

    public function deleteHandler(Request $request, Response $response, $args)
    {
        $id = $args['id'];
        $post_id = $args['post'];

        if(!$id || !$post_id){
            return $this->view->render($response, '404.php', ['title' => '404 not found']);
        }

        \App\Model\Review::find($id)->delete();

        $post = \App\Model\Post::find($post_id);

        return $response->withRedirect('/post/' . $post->id . '/' . Formater::space2dash($post->title));
    }
}
