<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Post</a>
            </li>
            <li class="breadcrumb-item active">Review</li>
        </ol>

        <div class="row">
            <div class="col-lg-12">
                <?php if(isset($msg)):?>
                <div class="alert alert-success my-2"><strong>
                        <i class="fas fa-check-circle"></i> Success! </strong> <?=$msg?>,
                    <a href="<?=$link?>">Please view your post here</a>
                </div>
                <?php endif ?>
                <?php if(isset($error)):?>
                <div class="alert alert-danger my-2"><strong>
                        <i class="fas fa-times"></i> Failed! </strong> <?=$error?>
                </div>
                <?php endif ?>
            </div>
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="/review/create" method="POST">
                            <div class="form-group">
                                <label>Please write your review</label>
                                <input type="hidden" name="post_id" value="<?=$post_id?>">
                                <textarea class="form-control" name="body" id="editor"
                                    placeholder="Please write why you did'nt accept the article"></textarea>
                                <?php if(isset($errors)):?>
                                <small class="form-text text-danger"><?=$errors->body?></small>
                                <?php endif ?>
                            </div>
                            <button type="submit" class="btn btn-primary float-right mb-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>