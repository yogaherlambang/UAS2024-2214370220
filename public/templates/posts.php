<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#"><?=$title?></a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
        </ol>

        <div class="row">
            <div class="col-lg-12">
                <?php if(isset($msg)):?>
                <div class="alert alert-success my-2"><strong>
                    <i class="fas fa-check-circle"></i> Success! </strong> <?=$msg?>,
                </div>
                <?php endif ?>
                <?php if(isset($error)):?>
                <div class="alert alert-danger my-2"><strong>
                    <i class="fas fa-times"></i> Failed! </strong> <?=$error?>
                </div>
                <?php endif ?>
            </div>
            <div class="col-lg-12">
                <a class="btn btn-outline-primary my-2 float-right" href="/post/create"><i class="fas fa-plus"></i> Add
                    post</a>
            </div>
            <div class="col-lg-12">
                <!-- DataTables Example -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Posts</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th width="150px">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach($posts as $post):?>
                                    <tr>
                                        <td><?= htmlspecialchars($post->title); ?></td>
                                        <td>
                                            <?php if(strtolower($post->status) === 'approved'):?>
                                            <span class="badge badge-success"> <i class="fas fa-check-double"></i>
                                                <?=ucfirst($post->status)?></span>
                                            <?php elseif(strtolower($post->status) === 'pending'):?>
                                            <span class="badge badge-warning"> <i class="fas fa-sync"></i>
                                                <?=ucfirst($post->status)?></span>
                                            <?php elseif(strtolower($post->status) === 'blocked'):?>
                                            <span class="badge badge-danger"> <i class="fas fa-ban"></i>
                                                <?=ucfirst($post->status)?></span>
                                            <?php endif?>
                                        </td>
                                        <td><?=$post->created_at?></td>
                                        <td>
                                            <a href="/post/<?=$post->id?>/<?=\App\Helper\Formater::space2dash($post->title)?>"
                                                class="btn btn-outline-success btn-sm" data-toggle="tooltip"
                                                data-placement="left" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="/post/edit/<?=$post->id?>/<?=\App\Helper\Formater::space2dash($post->title)?>"
                                                class="btn btn-outline-info btn-sm" data-toggle="tooltip"
                                                data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                            <a href="/post/block/<?=$post->id?>/<?=\App\Helper\Formater::space2dash($post->title)?>" class="btn btn-outline-warning btn-sm" data-toggle="tooltip"
                                                data-placement="bottom" title="Block"><i class="fas fa-ban"></i></a>
                                            <a href="/post/delete/<?=$post->id?>/<?=\App\Helper\Formater::space2dash($post->title)?>"
                                                onclick="return deleteConfirmation(this)"
                                                class="btn btn-outline-danger btn-sm" data-toggle="tooltip"
                                                data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modals"></div>