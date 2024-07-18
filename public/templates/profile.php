<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>

        <div class="row">
            <div class="col-lg-3">
                <div class="profile-img text-center">
                    <img src="<?=htmlspecialchars($user->avatar)?>" alt="" class="avatar">
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row mb-2">
                    <div class="col-lg-6">
                        <h3>Personal info</h3>
                    </div>
                    <div class="col-lg-6 text-right">
                        <?php if(\App\Helper\Session::get('auth')->id === $user->id || \App\Helper\Session::get('auth')->role === 'admin') :?>
                        <a href="/user/update/<?=htmlspecialchars($user->username)?>" class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i> 
                            Edit profile
                        </a>
                        <a href="/user/changepass/<?=htmlspecialchars($user->username)?>" class="btn btn-info btn-sm">
                        <i class="fas fa-key"></i> 
                            Change password 
                        </a>
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form class="form-horizontal" role="form">
                        <div class="form-group row">
                            <label class="col-lg-2 control-label">Name:</label>
                            <div class="col-lg-9">
                                <input class="form-control-plaintext" readonly type="text"
                                    value="<?=htmlspecialchars($user->name)?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 control-label">Username:</label>
                            <div class="col-lg-9">
                                <input class="form-control-plaintext" type="text" readonly
                                    value="<?=htmlspecialchars($user->username)?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 control-label">Email:</label>
                            <div class="col-lg-9">
                                <input class="form-control-plaintext" type="text" readonly
                                    value="<?=htmlspecialchars($user->email)?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 control-label">Work:</label>
                            <div class="col-lg-9">
                                <input class="form-control-plaintext" type="text" readonly
                                    value="<?=htmlspecialchars($user->work)?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 control-label">Facebook:</label>
                            <div class="col-lg-9">
                                <input class="form-control-plaintext" type="text" readonly
                                    value="<?=htmlspecialchars($user->facebook)?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 control-label">LinkedIn:</label>
                            <div class="col-lg-9">
                                <input class="form-control-plaintext" type="text" readonly
                                    value="<?=htmlspecialchars($user->linkedin)?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 control-label">Twitter:</label>
                            <div class="col-lg-9">
                                <input class="form-control-plaintext" type="text" readonly
                                    value="<?=htmlspecialchars($user->twitter)?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 control-label">Github:</label>
                            <div class="col-lg-9">
                                <input class="form-control-plaintext" type="text" readonly
                                    value="<?=htmlspecialchars($user->github)?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 control-label">Website:</label>
                            <div class="col-lg-9">
                                <input class="form-control-plaintext" type="text" readonly
                                    value="<?=htmlspecialchars($user->website)?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 control-label">About:</label>
                            <div class="col-lg-9 text-justify">
                                <?=$user->about?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="modals"></div>