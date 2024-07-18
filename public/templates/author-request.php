<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#"><?=$title; ?></a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
        </ol>

        <div class="row">
            <div class="col-lg-12">
                <?php if (isset($msg)):?>
                <div class="alert alert-success my-2"><strong>
                        <i class="fas fa-check-circle"></i> Success! </strong> <?=$msg; ?>,
                </div>
                <?php endif; ?>
                <?php if (isset($error)):?>
                <div class="alert alert-danger my-2"><strong>
                        <i class="fas fa-times"></i> Failed! </strong> <?=$error; ?>
                </div>
                <?php endif; ?>
            </div>

            <div class="col-lg-12">
                <!-- DataTables Example -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        requests</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Interested Tech</th>
                                        <th width="80px">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Interested Tech</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($requests as $request):?>
                                    <tr>
                                        <td><?= htmlspecialchars($request->name); ?></td>
                                        <td><?=htmlspecialchars($request->email); ?></td>
                                        <td><?= htmlspecialchars($request->interested_tech); ?></td>
                                        <td>
                                            <a href="/request/<?=$request->id; ?>/<?=\App\Helper\Formater::space2dash($request->name); ?>"
                                                class="btn btn-outline-success btn-sm" data-toggle="tooltip"
                                                data-placement="left" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="/request/delete/<?=$request->id; ?>/<?=\App\Helper\Formater::space2dash($request->name); ?>"
                                                onclick="return deleteConfirmation(this)"
                                                class="btn btn-outline-danger btn-sm" data-toggle="tooltip"
                                                data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
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