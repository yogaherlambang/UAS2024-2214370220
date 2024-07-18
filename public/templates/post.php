<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Post</a>
            </li>
            <li class="breadcrumb-item active"><?= $post->title; ?></li>
        </ol>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <?php if ($post->status === 'blocked') : ?>
                    <div class="my-2">
                        <div class="alert alert-warning d-flex">
                            <i class="fas fa-exclamation-triangle" style="font-size:50px"></i>
                            <div class="d-flex flex-column">
                                <strong class="ml-3">Declined! </strong>
                                <span class="ml-3">Your article has been declained for view in public, Please see the
                                    comments below
                                    , review and resubmit your article</span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-lg-8 d-flex align-items-center">
                        <img class="avatar" src="<?= $post->users->avatar; ?>" alt="avatar">
                        <a class="pl-2" href="/user/<?=htmlspecialchars($post->users->username); ?>">
                            <h4><?= htmlspecialchars($post->users->name); ?></h4>
                        </a>
                        <div class="text-center" style="font-size:12px; margin-top:-5px;">
                            <span class="px-2"> <i class="fas fa-eye"></i> <?= $post->views; ?></span>
                            <span class="px-2"><i class="fas fa-clock"></i> <?= \App\Helper\Formater::dateFormat($post->created_at, 'M-d-Y'); ?></span>
                            <span class="px-2"> <i class="fas fa-book-reader"></i> <?= $post->read_time; ?></span>
                        </div>
                    </div>

                    <div class="col-lg-4 text-right">
                        <?php if (\App\Helper\Session::get('auth')->id !== $post->users->id):?>
                        <a href="/post/approve/<?=$post->id; ?>/<?=\App\Helper\Formater::space2dash($post->title); ?>" class="btn btn-success"> <i class="fas fa-check-double"></i> Approve</a>
                        <a href="/post/block/<?=$post->id; ?>/<?=\App\Helper\Formater::space2dash($post->title); ?>" class="btn btn-danger"> <i class="fas fa-ban"></i> Block</a>
                        <?php endif; ?>
                    </div>
                </div>

                <h2 class="my-4"><?= htmlspecialchars($post->title); ?></h2>
                <div class="article">
                    <?php if (strlen($post->cover_img) > 0) : ?>
                        <img class="mb-3" src="<?= $post->cover_img; ?>" alt="Cover Image">
                    <?php endif; ?>

                    <?= $post->body; ?>
                    <hr>
                    <h3>Review</h3>
                    <div class="comments my-3">
                        <?php foreach ($post->reviews as $review) : ?>
                            <div class="card my-1">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-11 d-flex align-items-center">
                                            <img class="avatar-comment" src="<?= $review->user->avatar; ?>" alt="avatar">
                                            <a class="pl-2" style="margin-top:5px" href="/user/<?= htmlspecialchars($review->user->username); ?>">
                                                <h5><?= htmlspecialchars($review->user->name); ?></h5>
                                            </a>
                                            <span class="px-2"><i class="fas fa-clock"></i> <?= $review->created_at; ?></span>
                                        </div>
                                        <div class="col-lg-1">
                                            <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                                    <a class="dropdown-item" href="/review/<?= $post->id; ?>/<?= \App\Helper\Formater::space2dash($post->title); ?>"> <i class="fas fa-reply-all"></i> Reply</a>
                                                    <?php if (\App\Helper\Session::get('auth')->id === $review->user->id) : ?>
                                                        <a class="dropdown-item" href="/review/edit/<?= $review->id; ?>/<?= $post->id; ?>"><i class="fas fa-edit"></i> Edit</a>
                                                        <a class="dropdown-item" href="/review/delete/<?= $review->id; ?>/<?= $post->id; ?>"><i class="fas fa-trash"></i> Delete</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-text card-text py-2">
                                        <?= $review->body; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<script>
    var pres = document.querySelectorAll('pre');
    pres.forEach(function(pre) {
        pre.classList.add('prettyprint');
    });

    var paragraphs = document.querySelectorAll('p');
    paragraphs.forEach(function(p) {
        p.classList.add('text-justify');
    })

    var images = document.querySelectorAll('.article img');
    images.forEach(function(img) {
        img.setAttribute('width', '100%');
    });
</script>