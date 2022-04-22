<?= $this->extend('auth/templates/temp'); ?>

<?= $this->section('authContent'); ?>
<div class="login-box">
    <div class="card card-outline card-primary custom-card-auth">
        <div class="card-body">
            <h4 class="login-box-msg"><b>REGISTER</b></h4>
            <?= view('Myth\Auth\Views\_message_block') ?>
            <form action="<?= route_to('register') ?>" method="post" class="mb-3">
                <?= csrf_field() ?>

                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <input type="email" aria-describedby="emailHelp" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" name="email" autofocus>
                    <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off" id="password-input-1">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <button class="btn p-0 m-0 btn-show" id="psw-show" type="button">
                                <span class="fas fa-eye"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off" id="password-input-2">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <button class="btn p-0 m-0 btn-show" id="retypepsw-show" type="button">
                                <span class="fas fa-eye"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-7">
                    </div>
                    <!-- /.col -->
                    <div class="col-5">
                        <button type="submit" class="btn btn-outline-primary btn-block"><?= lang('Auth.register') ?></button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mb-0 text-center">
                <?= lang('Auth.alreadyRegistered') ?>
                <a href="<?= route_to('login') ?>"><?= lang('Auth.signIn') ?></a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<?= $this->endSection(); ?>