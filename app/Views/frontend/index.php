<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Top Navigation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte'); ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte'); ?>/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <?= $this->include('frontend/common/topbar'); ?>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <?= $this->renderSection('content'); ?>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <?= $this->include('frontend/common/footer'); ?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url('assets/adminlte'); ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/adminlte'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/adminlte'); ?>/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url('assets/adminlte'); ?>/js/demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= base_url('assets/js/dataprovinsi.js'); ?>"></script>

    <?php if ($validation) : ?>
        <?php if (old('upgrade')) : ?>
            <script type='text/javascript'>
                $(document).ready(function() {
                    $('#upgrade').modal('show');
                });
            </script>
        <?php elseif (old('edit')) : ?>
            <script type='text/javascript'>
                $(document).ready(function() {
                    $('#edit').modal('show');
                });
            </script>
        <?php elseif (old('tambah-produk')) : ?>
            <script type='text/javascript'>
                $(document).ready(function() {
                    $('#tambah-produk').modal('show');
                });
            </script>
        <?php elseif (old('edit-produk')) : ?>
            <script type='text/javascript'>
                $(document).ready(function() {
                    var id = $('#btneditproduk').attr('data-id');
                    $('#edit-produk-' + id).modal('show');
                });
            </script>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (!empty(session()->getFlashdata('success'))) : ?>
        <script>
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Berhasil!',
                position: 'bottomLeft',
                body: '<?= session()->getFlashdata('success') ?>'
            })
        </script>
    <?php elseif (!empty(session()->getFlashdata('fail'))) : ?>
        <script>
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Gagal!',
                position: 'bottomLeft',
                body: '<?= session()->getFlashdata('fail') ?>'
            })
        </script>
    <?php endif; ?>

    <script>
        function profileImage() {
            const profilePic = document.querySelector('#profile_picture');
            const profilePicLabel = document.querySelector('.custom-file-label');
            const profilePreview = document.querySelector('.img-profile-preview');

            profilePicLabel.textContent = profilePic.files[0].name;

            const fileProfile = new FileReader();
            fileProfile.readAsDataURL(profilePic.files[0]);

            fileProfile.onload = function(e) {
                profilePreview.src = e.target.result;
            }
        }

        function storeImage() {
            const storeImage = document.querySelector('#store_image');
            const storeImageLabel = document.querySelector('.store-image');

            storeImageLabel.textContent = storeImage.files[0].name;
        }

        function ktpImage() {
            const ktpImage = document.querySelector('#ktp_image');
            const ktpImageLabel = document.querySelector('.ktp-image');

            ktpImageLabel.textContent = ktpImage.files[0].name;
        }

        function storeLogo() {
            const storeLogo = document.querySelector('#store_logo');
            const storeLogoLabel = document.querySelector('.store-logo');

            storeLogoLabel.textContent = storeLogo.files[0].name;
        }

        function productImage() {
            const productImg = document.querySelector('#product_thumbnail');
            const productImgLabel = document.querySelector('.productNameAdd');

            productImgLabel.textContent = productImg.files[0].name;
        }

        function editProductImage() {
            const productImg = document.querySelector('#product_thumbnail_edit');
            const productImgLabel = document.querySelector('.productNameEdit');

            productImgLabel.textContent = productImg.files[0].name;
        }
    </script>
</body>

</html>