<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/user/<?=htmlspecialchars($user->username)?>"">Profile</a>
            </li>
            <li class="breadcrumb-item active">Change password</li>
        </ol>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
            <?php if (isset($msg)): ?>
                <div class="alert alert-success alert-dismissable">
                    <a class="panel-close close" data-dismiss="alert">×</a>
                    <i class="fa fa-check"></i>
                  <strong>  Success! </strong> <?=$msg?>
                </div>
                <?php endif?>
                <?php if (isset($error)): ?>
                <div class="alert alert-danger alert-dismissable">
                    <a class="panel-close close" data-dismiss="alert">×</a>
                    <i class="fa fa-times"></i>
                    <strong> Error! </strong> <?=$error?>
                </div>
              <?php endif?>
                <div class="col-lg-12 mt-3">
                    <form class="form-horizontal" role="form" method="post" action="/user/changepass">
                        <div class="form-group row">
                            <label class="col-md-3 control-label">Current password:</label>
                            <div class="col-md-9">
                            <input type="hidden" name="id" value="<?=htmlspecialchars($user->id)?>">
                                <input class="form-control" type="password" name="password" value="<?=$input->password?>">
                                <?php if (isset($errors)): ?>
                                <small class="form-text text-danger"><?=$errors->password?></small>
                                <?php endif?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 control-label">New password:</label>
                            <div class="col-md-9">
                                <input class="form-control" type="password" name="new_password" value="<?=$input->new_password?>">
                                <?php if (isset($errors)): ?>
                                <small class="form-text text-danger"><?=$errors->new_password?></small>
                                <?php endif?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 control-label">Confirm password:</label>
                            <div class="col-md-9">
                                <input class="form-control" type="password" name="confirm_password" value="<?=$input->confirm_password?>">
                                <?php if (isset($errors)): ?>
                                <small class="form-text text-danger"><?=$errors->confirm_password?></small>
                                <?php endif?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8">
                            <button type="submit" class="btn btn-primary  ">Save Changes</button>
                                <span></span>
                                <input type="reset" class="btn btn-secondary" value="Cancel">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="modals"></div>