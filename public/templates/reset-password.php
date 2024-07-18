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
      <div class="card-header">
        <h3 class="text-center">Reset password</h3>
      </div>
      <div class="card-body">
        <form method="POST" action="/auth/passwordreset">
          <div class="form-group">
            <input type="hidden" name="token" class="form-control" value="<?=$token?>">
            <input type="password" name="password" class="form-control" placeholder="New password"
              autofocus="autofocus">
            <?php if(isset($errors)):?>
            <small class="form-text text-danger"><?=$errors->password?></small>
            <?php endif ?>
          </div>
          <div class="form-group">
            <input type="password" name="confirm_password" class="form-control " placeholder="Confirm Password">
            <?php if(isset($errors)):?>
            <small class="form-text text-danger"><?=$errors->confirm_password?></small>
            <?php endif ?>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Reset</button>
        </form>

        <?php if(isset($error)):?>
        <div class="alert alert-danger my-2"><strong>
            <i class="fas fa-times"></i> Failed! </strong> <?=$error?>
        </div>
        <?php endif ?>

        <?php if(isset($msg)):?>
        <div class="alert alert-success my-2"><strong>
            <i class="fas fa-check"></i> Success! </strong> <?=$msg?>
        </div>
        <?php endif ?>

        <div class="text-center">
            <a class="d-block small mt-3" href="/">Back to login</a>
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

</body>

</html>