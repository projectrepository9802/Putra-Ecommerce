<?= $this->extend('auth/templates/temp'); ?>

<?= $this->section('authContent'); ?>
<div class="login-box">
    <div class="card card-outline card-primary custom-card-auth">
        <div class="card-body">
            <h4 class="login-box-msg"><b>Forgot Password</b></h4>
            <p class="text-center"><?= lang('Auth.enterEmailForInstructions') ?></p>
            <?= view('Myth\Auth\Views\_message_block') ?>
            <form action="<?= route_to('forgot') ?>" method="post" class="mb-3">
                <?= csrf_field() ?>

                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" placeholder="<?= lang('Auth.email') ?>" autofocus>
                    <div class="invalid-feedback">
                        <?= session('errors.email') ?>
                    </div>
                </div>

                <div class="row">
                    <button type="submit" class="btn btn-outline-primary btn-block"><?= lang('Auth.sendInstructions') ?></button>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<?= $this->endSection(); ?>