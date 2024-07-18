<?php
$app->get('/dashboard', function ($request, $response, $args) {
    $totalPostCount = \App\Model\Post::count();

    $pendingPost = \App\Model\Post::where('status', 'pending')->get();
    $pendingPostCount = $pendingPost->count();

    $blockedPost =  \App\Model\Post::where('status', 'blocked')->get();
    $blockedPostCount = $blockedPost->count();

    $userCount = \App\Model\User::count();


    $this->renderer->setLayout('layout.php');
    return $this->renderer->render($response, "dashboard.php", [
        "title" => "Dashboard",
        "totalPost" => $totalPostCount,
        "totalPendingPost" => $pendingPostCount,
        "totalBlockedPost" => $blockedPostCount,
        "totalUsers" => $userCount
    ]);
});
