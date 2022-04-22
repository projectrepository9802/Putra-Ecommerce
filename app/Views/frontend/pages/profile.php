<?= $this->extend('frontend/index'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <div class="content-header">
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-lg-3">
                    <?php if ($profile_status) : ?>
                        <div class="card card-primary card-outline h-100">
                            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active mb-4">
                                        <div class="card-header">
                                            <h3 class="card-title">About Me</h3>
                                        </div>
                                        <div class="card-body box-profile">
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/images'); ?>/<?= user()->profile_pic; ?>" alt="User profile picture">
                                            </div>

                                            <h3 class="profile-username text-center"><?= (user()->fullname) ? user()->fullname : user()->username; ?></h3>

                                            <p class="text-muted text-center">
                                                <?= $level['group_id'] == '3' ? 'Pembeli' : 'Penjual'; ?>
                                            </p>

                                            <strong><i class="fas fa-book mr-1"></i> E-mail</strong>

                                            <p class="text-muted">
                                                <?= user()->email; ?>
                                            </p>

                                            <hr>

                                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Nama Lengkap</strong>

                                            <p class="text-muted"><?= user()->fullname ? user()->fullname : 'Edit Profile Untuk Mengganti Nama Anda'; ?></p>

                                            <hr>

                                            <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#editProfile"><b>Edit Profile</b></a>
                                        </div>
                                    </div>
                                    <div class="carousel-item mb-4">
                                        <div class="card-header">
                                            <h3 class="card-title">Store Detail</h3>
                                        </div>
                                        <div class="card-body box-profile">
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/images/merchants'); ?>/<?= $profile_status['store_name']; ?>/<?= $profile_status['store_logo']; ?>" alt="User profile picture">
                                            </div>

                                            <h3 class="profile-username text-center"><?= $profile_status['store_name']; ?></h3>

                                            <div class="row text-muted text-center mb-4">
                                                <div class="col-6">
                                                    <?php if ($profile_status['merchant_status'] == 'active') : ?>
                                                        <i class="fas fa-circle" style="color: green;"></i> <b><?= ucwords($profile_status['merchant_status']); ?></b>
                                                    <?php else : ?>
                                                        <i class="fas fa-circle" style="color: red;"></i> <b><?= ucwords($profile_status['merchant_status']); ?></b>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-6">
                                                    <?php if ($profile_status['verified'] == 'true') : ?>
                                                        <i class="fas fa-check-circle" style="color: blue;"></i> <b>Verified</b>
                                                    <?php else : ?>
                                                        <i class="fas fa-minus-circle" style="color: red;"></i></i> <b>Unverified</b>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat Lengkap</strong>

                                            <p class="text-muted"><?= $profile_status['store_address']; ?></p>

                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/images'); ?>/<?= user()->profile_pic; ?>" alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center"><?= (user()->fullname) ? user()->fullname : user()->username; ?></h3>

                                <p class="text-muted text-center">
                                    <?= $level['group_id'] == '3' ? 'Pembeli' : 'Penjual'; ?>
                                </p>

                                <strong><i class="fas fa-book mr-1"></i> E-mail</strong>

                                <p class="text-muted">
                                    <?= user()->email; ?>
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Nama Lengkap</strong>

                                <p class="text-muted"><?= user()->fullname ? user()->fullname : 'Edit Profile Untuk Mengganti Nama Anda'; ?></p>

                                <hr>

                                <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#editProfile"><b>Edit Profile</b></a>
                                <?php if ($profile_status) : ?>
                                    <?php if ($profile_status['user_id'] != user_id()) : ?>
                                        <button class="btn btn-info btn-block" data-toggle="modal" data-target="#upgrade"><b>Upgrade Keanggotaan</b></button>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <button class="btn btn-info btn-block" data-toggle="modal" data-target="#upgrade"><b>Upgrade Keanggotaan</b></button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <?php if ($profile_status) : ?>
                                            <?php if ($profile_status['merchant_status'] == 'active') : ?>
                                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Produk</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#ordernotif" data-toggle="tab">Order List</a></li>
                                            <?php else : ?>
                                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Produk</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#ordernotif" data-toggle="tab">Order List</a></li>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <li class="nav-item"><a class="nav-link <?= $profile_status ? '' : 'active'; ?>" href="#cart" data-toggle="tab">Cart</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane <?= $profile_status ? 'active' : ''; ?>" id="activity">
                                            <?php if ($profile_status) : ?>
                                                <?php if ($profile_status['merchant_status'] == 'active') : ?>
                                                    <div class="row-col-12 mb-2">
                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambah-produk">Tambah Produk</button>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <div class="row">
                                                <?php if ($products) : ?>
                                                    <?php foreach ($products as $product) : ?>
                                                        <div class="col-lg-3">
                                                            <div class="card card-primary card-outline">
                                                                <div class="card-header">
                                                                    <h3 class="card-title"><?= $product['product_name']; ?></h3>
                                                                    <div class="card-tools">
                                                                        <span class="badge badge-primary"><?= $product['stock']; ?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <img src="<?= base_url('assets/images/merchants'); ?>/<?= $product['product_thumbnail']; ?>" class="img-fluid mb-2" alt="">
                                                                    <h5>Rp. <?= $product['product_price']; ?></h5>
                                                                    <p class="card-text">
                                                                        <?= $product['product_description']; ?>
                                                                    </p>
                                                                </div>
                                                                <div class="card-footer text-center">
                                                                    <button class="btn btn-warning" data-toggle="modal" data-target="#edit-produk-<?= $product['id']; ?>" style="color: white;"><i class="fas fa-edit"></i> Edit</button>
                                                                    <form action="/profile" method="post" class="d-inline">
                                                                        <?= csrf_field(); ?>
                                                                        <input type="hidden" name="id_produk" value="<?= $product['id']; ?>">
                                                                        <input type="hidden" name="fungsi" value="hapus">
                                                                        <button type="submit" name="hapusProduk" value="hapusProduk" class="btn btn-danger card-link"><i class="fas fa-trash-alt"></i> Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <div class="col-lg-12 text-center">
                                                        <img src="<?= base_url('assets/images'); ?>/no-product.png" alt="">
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="tab-pane <?= $profile_status ? '' : 'active'; ?>" id="ordernotif">
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <img src="<?= base_url('assets/images'); ?>/no-product.png" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane <?= $profile_status ? '' : 'active'; ?>" id="cart">
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <img src="<?= base_url('assets/images'); ?>/no-product.png" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->include('frontend/common/modal-profile'); ?>
    </div>
</div>

<?= $this->endSection(); ?>