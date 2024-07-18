<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $title ?></title>

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
        <h3>Login</h3>
      </div>
      <div class="card-body">
        <form method="POST" action="/">
          <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Email address or username" autofocus="autofocus">
            <?php if (isset($errors)) : ?>
              <small class="form-text text-danger"><?= $errors->username ?></small>
            <?php endif ?>
          </div>
          <div class="form-group">
            <input type="password" name="password" class="form-control " placeholder="Password">
            <?php if (isset($errors)) : ?>
              <small class="form-text text-danger"><?= $errors->password ?></small>
            <?php endif ?>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="remember" value="remember-me">
                Remember Password
              </label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>

        <?php if (isset($error)) : ?>
          <div class="alert alert-danger my-2"><strong>
              <i class="fas fa-times"></i> Failed! </strong> <?= $error ?>
          </div>
        <?php endif ?>

        <div class="text-center">
          <a class="d-block small" href="/auth/forgotpassword">Forgot Password?</a>
          <a class="d-block small mt-3" href="https://synchlabcoding.com">synchlabcoding.com</a>
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