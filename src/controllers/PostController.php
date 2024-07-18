<?php

namespace App\Controller;

use App\Helper\Formater;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class PostController
{
    /**
     * @var Slim\Views\PhpRenderer
     */
    private $view;

    public function __construct(PhpRenderer $view)
    {
        $this->view = $view;
    }

    public function index(Request $request, Response $response)
    {
        $posts = \App\Model\Post::all();

        return $this->view->render($response, 'posts.php', ['title' => 'Posts', 'posts' => $posts]);
    }

    public function myPosts(Request $request, Response $response)
    {
        $name = \App\Helper\Session::get('auth')->name;

        //$user = \App\Model\User::where(name, '=', $name)->first();

        $allPosts = \App\Model\Post::where(['users_id' => $user->id])->get();

        return $this->view->render($response, 'posts.php', ['title' => 'My post', 'posts' => $allPosts]);
    }

    public function view(Request $request, Response $response, $args)
    {
        $id = $args['id'];
        $titile = $args['title'];

        if (strlen($id) < 1) {
            return $this->view->render($response, '404.php');
        }

        $post = \App\Model\Post::find($id);

        $htmlPost = \Parsedown::instance()
            ->setBreaksEnabled(false) // enables automatic line breaks
            ->text($post->body);

        $post->body = $htmlPost;
        foreach ($post->reviews as $review) {
            $htmlReview = \Parsedown::instance()
                ->setBreaksEnabled(false) // enables automatic line breaks
                ->text($review->body);
            $review->body = $htmlReview;
        }

        return $this->view->render($response, 'post.php', ['title' => $post->title, 'post' => $post]);
    }

    public function createFormHandler(Request $request, Response $response)
    {
        return $this->view->render($response, 'add-post.php', ['title' => 'Create new post']);
    }

    public function createHandler(Request $request, Response $response)
    {
        $body = $request->getParsedBody();
        $errors = $this->validateData($body);

        $allTags = $body['tags'];
        //dnd($allTags);
        if ($errors) {
            return $this->view->render(
                $response,
                'add-post.php',
                [
                    'title' => 'Create new post',
                    'data' => (object) $body,
                    'errors' => (object) $errors,
                ]
            );
        }

        $existingTags = \App\Model\Tag::all();

        $allTag = [];
        foreach ($existingTags as $tag) {
            $allTag[] = $tag->name;
        }
        foreach ($allTags as $t) {
            if (!in_array($t, $allTag)) {
                \App\Model\Tag::create([
                    'name' => $t,
                ]);
            }
        }

        $id = \Ramsey\Uuid\Uuid::uuid4();

        $tags = [];
        foreach ($allTags as $tag) {
            $tagId = \App\Model\Tag::where('name', $tag)->first()->id;
            $tags[] = $tagId;
        }

        foreach ($tags as $t) {
            $tagInput = [
                'post_id' => $id,
                'tag_id' => $t,
            ];
            \App\Model\TagMap::create($tagInput);
        }

        $postBody = \Parsedown::instance()
            ->setBreaksEnabled(false) // enables automatic line breaks
            ->text($body['body']);

        $plainPostBody = strip_tags($postBody);

        $readTime = \App\Helper\Util::getReadTime($plainPostBody).' min read';

        $input = [
            'id' => $id,
            'title' => $body['title'],
            'cover_img' => $body['cover_img'],
            'body' => $body['body'],
            'subject' => $body['subject'],
            'meta_desc' => $body['meta_desc'],
            'users_id' => \App\Helper\Session::get('auth')->id,
            'read_time' => $readTime,
        ];

        if (\App\Model\Post::create($input)) {
            return $this->view->render(
                $response,
                'add-post.php',
                [
                    'title' => 'Create new post',
                    'msg' => 'Post Created',
                    'link' => '/post/'.$id.'/'.Formater::space2dash($body['title']),
                ]
            );
        } else {
            return $this->view->render(
                $response,
                'add-post.php',
                [
                    'title' => 'Create new post',
                    'error' => 'Failed to creat post',
                ]
            );
        }
    }

    /**
     * Handles the form for edit post.
     */
    public function editFormHandler(Request $request, Response $response, $args)
    {
        $id = $args['id'];
        $titile = $args['title'];

        if (!$id && !$titile) {
            return $this->view->render($response, '404.php', ['title' => '404 Not found']);
        }

        $post = \App\Model\Post::find($id);

        return $this->view->render($response, 'edit-post.php', ['title' => 'Edit post', 'data' => $post]);
    }

    public function editHandler(Request $request, Response $response)
    {
        $body = $request->getParsedBody();
        $errors = $this->validateData($body);

        if ($errors) {
            return $this->view->render(
                $response,
                'add-post.php',
                [
                    'title' => 'Edit post',
                    'data' => (object) $body,
                    'errors' => (object) $errors,
                ]
            );
        }

        $postBody = \Parsedown::instance()
            ->setBreaksEnabled(false) // enables automatic line breaks
            ->text($body['body']);

        $plainPostBody = strip_tags($postBody);

        $readTime = \App\Helper\Util::getReadTime($plainPostBody).' min read';

        $input = [
            'title' => $body['title'],
            'cover_img' => $body['cover_img'],
            'body' => $body['body'],
            'subject' => $body['subject'],
            'meta_desc' => $body['meta_desc'],
            'read_time' => $readTime,
        ];

        if (\App\Model\Post::find($body['id'])->update($input)) {
            $updatedPost = \App\Model\Post::find($body['id']);

            return $this->view->render(
                $response,
                'edit-post.php',
                [
                    'title' => 'Edit post',
                    'data' => $updatedPost,
                    'msg' => 'Post Updated',
                    'link' => '/post/'.$body['id'].'/'.Formater::space2dash($body['title']),
                ]
            );
        } else {
            return $this->view->render(
                $response,
                'edit-post.php',
                [
                    'title' => 'Edit post',
                    'error' => 'Failed to update post',
                ]
            );
        }
    }

    public function deleteHandler(Request $request, Response $response, $args)
    {
        $id = $args['id'];
        $titile = $args['title'];

        if (!$id || !$titile) {
            return $this->view->render($response, '404.php', ['title' => '404 not found']);
        }

        if (\App\Model\Post::find($id)->delete()) {
            $posts = \App\Model\Post::all();

            return $this->view->render(
                $response,
                'posts.php',
                [
                    'title' => 'Posts',
                    'posts' => $posts,
                    'msg' => 'Post deleted',
                ]
            );
        } else {
            return $this->view->render(
                $response,
                'posts.php',
                [
                    'title' => 'Posts',
                    'error' => 'Failed to delete post',
                ]
            );
        }
    }

    public function blockHandler(Request $request, Response $response, $args)
    {
        $id = $args['id'];
        $titile = $args['title'];

        if (!$id || !$titile) {
            return $this->view->render($response, '404.php', ['title' => '404 not found']);
        }

        return $response->withRedirect('/review/'.$id.'/'.Formater::space2dash($titile));
    }

    public function approveHandler(Request $request, Response $response, $args)
    {
        $id = $args['id'];
        $titile = $args['title'];

        if (!$id || !$titile) {
            return $this->view->render($response, '404.php', ['title' => '404 not found']);
        }

        if (!\App\Model\Post::find($id)->update(['status' => 'approved'])) {
            return $this->view->render($response, '500.php', ['title' => '500 internal server error']);
        }

        return $response->withRedirect('/post/'.$id.'/'.Formater::space2dash($titile));
    }

    private function validateData($body)
    {
        $errors = [
            'title' => '',
            'cover_img' => '',
            'subject' => '',
            'body' => '',
            'meta_desc' => '',
        ];

        $hasError = false;

        if (strlen($body['title']) < 1) {
            $hasError = true;
            $errors['title'] = 'Please enter title';
        }

        if (strlen($body['cover_img']) < 1) {
            $hasError = true;
            $errors['cover_img'] = 'Please enter cover image url';
        }

        if (empty($body['subject'])) {
            $hasError = true;
            $errors['subject'] = 'Please select suject';
        }

        if (empty($body['body'])) {
            $hasError = true;
            $errors['body'] = 'Please write something in your article';
        }

        if (empty($body['meta_desc'])) {
            $hasError = true;
            $errors['meta_desc'] = 'Please enter meta description';
        }

        if ($hasError) {
            return $errors;
        } else {
            return false;
        }
    }
}
