<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/users">User</a>
            </li>
            <li class="breadcrumb-item active">Add new</li>

        </ol>
        <div class="text-right my-2" id="msg"></div>
        <div class="row">
            <div class="col-lg-12">
                <?php if (isset($msg)): ?>
                <div class="alert alert-success my-2"><strong>
                        <i class="fas fa-check-circle"></i> Success! </strong> <?=$msg?>

                </div>
                <?php endif?>
                <?php if (isset($error)): ?>
                <div class="alert alert-danger my-2"><strong>
                        <i class="fas fa-times"></i> Failed! </strong> <?=$error?>
                </div>
                <?php endif?>
                <div class="card mb-3">
                    <div class="card-body">
                        <form method="post" action="/user/create">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter name"
                                            value="">
                                        <?php if (isset($errors)): ?>
                                        <small class="form-text text-danger"><?=$errors->name?></small>
                                        <?php endif?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>UserName</label>
                                        <input type="text" name="username" class="form-control"
                                            placeholder="Enter username" value="">
                                        <?php if (isset($errors)): ?>
                                        <small class="form-text text-danger"><?=$errors->username?></small>
                                        <?php endif?>
                                    </div>
                                </div>

                            </div>

                            <div class=" row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Enter password" value="">
                                        <?php if (isset($errors)): ?>
                                        <small class="form-text text-danger"><?=$errors->password?></small>
                                        <?php endif?>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control"
                                            placeholder="Enter password" value="">
                                        <?php if (isset($errors)): ?>
                                        <small class="form-text text-danger"><?=$errors->email?></small>
                                        <?php endif?>
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary float-right mb-3">Create User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>