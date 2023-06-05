<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POS Bengkel | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('adminLTE/dist/css/login.css') ?>">
</head>

<body>
    <div class="wrapper">
        <div class="logo">
            <img src="https://i.pinimg.com/originals/a0/0b/e5/a00be55e375849108396f10c0027e236.png">
        </div>
        <div class="text-center mt-4 name">
            Login
        </div>
        <div class="text-center fs-6 mt-3">
            <p>Sign in to start your session</p>
        </div>

        <form class="p-3 mt-3" action="<?= base_url('auth/loginProcess') ?>" method="post">
            <?= csrf_field(); ?>
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" id="username" name="username" class="form-control" placeholder="username">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            </div>
            <button class="btn mt-3">Login</button>
        </form>
    </div>

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
</body>

</html>