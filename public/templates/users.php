<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Users</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
        </ol>

        <div class="row">
            <div class="col-lg-12">
                <?php if (isset($msg)): ?>
                <div class="alert alert-success my-2"><strong>
                        <i class="fas fa-check-circle"></i> Success! </strong> <?=$msg?>,
                </div>
                <?php endif?>
                <?php if (isset($error)): ?>
                <div class="alert alert-danger my-2"><strong>
                        <i class="fas fa-times"></i> Failed! </strong> <?=$error?>
                </div>
                <?php endif?>
            </div>
            <div class="col-lg-12">
                <a class="btn btn-outline-primary my-2 float-right" href="/user/create"><i class="fas fa-plus"></i> Add
                    new user</a>
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
                                        <th>sl no</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Designation</th>
                                        <th>Created-at</th>
                                        <th width="150px">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>sl no</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Designation</th>
                                        <th>Created-at</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1;foreach ($users as $user): ?>
                                    <tr>
                                        <td><?=$i?></td>
                                        <td><?=htmlspecialchars($user->name);?></td>
                                        <td><?=htmlspecialchars($user->username);?></td>
                                        <td><?=htmlspecialchars($user->work);?> </td>
                                        <td><?=$user->created_at?></td>

                                        <td>
                                            <a href="/user/<?= htmlspecialchars($user->username); ?>"
                                                class="btn btn-outline-success btn-sm" data-toggle="tooltip"
                                                data-placement="top" title="View"><i class="fas fa-eye"></i></a>

                                            <a href="/user/update/<?=$user->username?>"
                                                class="btn btn-outline-info btn-sm" data-toggle="tooltip"
                                                data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>

                                            <a href="/user/changepass/<?=$user->username?>"
                                                class="btn btn-outline-info btn-sm" data-toggle="tooltip"
                                                data-placement="top" title="Change password"><i class="fas fa-key"></i></a>

                                            <a href="/user/delete/<?=$user->id?>"
                                                onclick="return deleteConfirmation(this)"
                                                class="btn btn-outline-danger btn-sm" data-toggle="tooltip"
                                                data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php $i++;endforeach?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modals"></div>