<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/user/<?=htmlspecialchars($user->username)?>">Profile</a>
            </li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>

        <div class="row">
            <div class="col-lg-3 text-center">
                <div class="profile-img text-center">
                    <img src="<?=htmlspecialchars($user->avatar)?>" alt="" id="avatar" class="avatar" />
                </div>
                <label class="fileContainer badge badge-info mt-3">
                    <i class="fas fa-file-upload"></i> 
                    <span id="upload-text">Upload</span>
                    <input type="file" onchange="updateProfilePicture(event)" />
                </label>
            </div>
            <div class="col-lg-7">
                <?php if (isset($msg)): ?>
                <div class="alert alert-success alert-dismissable">
                    <a class="panel-close close" user-dismiss="alert">×</a>
                    <i class="fa fa-check"></i>
                    <strong> Success! </strong> <?=$msg?>
                </div>
                <?php endif?>
                <?php if (isset($error)): ?>
                <div class="alert alert-danger alert-dismissable">
                    <a class="panel-close close" user-dismiss="alert">×</a>
                    <i class="fa fa-times"></i>
                    <strong> Error! </strong> <?=$error?>
                </div>
                <?php endif?>
                <h3>Personal info</h3>

                <div class="col-lg-12">
                    <form class="form-horizontal" role="form" method="post" action="/user/update">
                        <div class="form-group row">
                            <label class="col-lg-2 control-label">Name:</label>
                            <div class="col-lg-9">
                                <input type="hidden" name="id" id="user_id" value="<?=htmlspecialchars($user->id)?>">
                                <input class="form-control" type="text" name="name"
                                    value="<?php echo isset($user) ? htmlspecialchars($user->name) : null ?>">
                                <?php if (isset($errors)): ?>
                                <small class="form-text text-danger"><?=$errors->name?></small>
                                <?php endif?>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-2 control-label">Email:</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="email"
                                    value="<?php echo isset($user) ? htmlspecialchars($user->email) : null ?>">
                                <?php if (isset($errors)): ?>
                                <small class="form-text text-danger"><?=$errors->email?></small>
                                <?php endif?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 control-label">Work:</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="work"
                                    value="<?php echo isset($user) ? htmlspecialchars($user->work) : null ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 control-label">Facebook:</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="facebook"
                                    value="<?php echo isset($user) ? htmlspecialchars($user->facebook) : null ?>">
                                <?php if (isset($errors)): ?>
                                <small class="form-text text-danger"><?=$errors->facebook?></small>
                                <?php endif?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 control-label">LinkedIn:</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="linkedin"
                                    value="<?php echo isset($user) ? htmlspecialchars($user->linkedin) : null ?>">
                                <?php if (isset($errors)): ?>
                                <small class="form-text text-danger"><?=$errors->linkedin?></small>
                                <?php endif?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 control-label">Twitter:</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="twitter"
                                    value="<?php echo isset($user) ? htmlspecialchars($user->twitter) : null ?>">
                                <?php if (isset($errors)): ?>
                                <small class="form-text text-danger"><?=$errors->twitter?></small>
                                <?php endif?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 control-label">Github:</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="github"
                                    value="<?php echo isset($user) ? htmlspecialchars($user->github) : null ?>">
                                <?php if (isset($errors)): ?>
                                <small class="form-text text-danger"><?=$errors->github?></small>
                                <?php endif?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 control-label">Website:</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="website"
                                    value="<?php echo isset($user) ? htmlspecialchars($user->website) : null ?>">
                                <?php if (isset($errors)): ?>
                                <small class="form-text text-danger"><?=$errors->website?></small>
                                <?php endif?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 control-label">About:</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="about"
                                    id="editor"><?php echo isset($user) ? htmlspecialchars($user->about) : null ?></textarea>
                                <?php if (isset($errors)): ?>
                                <small class="form-text text-danger"><?=$errors->about?></small>
                                <?php endif?>
                            </div>
                        </div>

                        <!--<div class="form-group row">
                            <label class="col-md-3 control-label">Password:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="password" value="11111122333">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 control-label">Confirm password:</label>
                            <div class="col-md-8">
                                <input class="form-control" type="password" value="11111122333">
                            </div>
                        </div>-->
                        <div class="form-group row">
                            <label class="col-md-2 control-label"></label>
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