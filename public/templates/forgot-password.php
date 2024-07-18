<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$title?></title>

    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin.css" rel="stylesheet">
    <link href="/css/theme.css" rel="stylesheet">

</head>

<body class="bg-dark">

    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Reset Password</div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <h4>Forgot your password?</h4>
                    <p>Enter your email address and we will send you instructions on how to reset your password.</p>
                </div>
                <form method="POST" action="/auth/forgotpassword" id="resetFrom">
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="inputEmail" name="email" class="form-control form-control-sm"
                                placeholder="Enter email address" autofocus="autofocus">
                            <label for="inputEmail">Enter email address</label>
                        </div>

                    </div>
                    <?php if (isset($errors)): ?>
                    <small class="form-text text-danger mb-2" style="margin-top:-10px"><?=$errors->email?></small>
                    <?php endif?>
                    <button type="submit" class="btn btn-primary btn-block font-weight-bold">Reset Password</button>
                </form>

                <?php if (isset($msg)): ?>
                <div class="alert alert-success my-2"><strong>
                        <i class="fas fa-check-circle"></i> Success! </strong> <?=$msg?>,
                    <a href="" onclick="submitResetFrom()"> <i class="fas fa-redo-alt"></i> Resent</a>
                </div>
                <?php endif?>
                <?php if (isset($error)): ?>
                <div class="alert alert-danger my-2"><strong>
                        <i class="fas fa-times"></i> Failed! </strong> <?=$error?>
                </div>
                <?php endif?>

                <div class="text-center">
                    <a class="d-block small mt-3" href="/">Login Page</a>
                    <a class="d-block small mt-3" href="https://synchlab.dev">1947-2019 &copy; Synchlab.dev</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="/js/main.js"></script>

</body>

</html>