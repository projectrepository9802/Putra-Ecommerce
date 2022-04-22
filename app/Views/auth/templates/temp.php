<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('auth/plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('auth/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('auth/dist/css/adminlte.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('auth/dist/css/style.css'); ?>">
</head>

<body class="hold-transition login-page">
    <div class="login-logo mb-4">
        <a href="#" class="h2 custom-font2 logo-font">
            <span class="h2 custom-font1 logo-font-part">P</span>utra
            <span class="h2 custom-font1 logo-font-part">E</span>commerce
        </a>
    </div>

    <?= $this->renderSection('authContent'); ?>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url('auth/plugins/jquery/jquery.min.js'); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('auth/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('auth/dist/js/adminlte.min.js'); ?>"></script>
    <script src="<?= base_url('auth/dist/js/jssystem.js'); ?>"></script>
</body>

</html>