<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container-fluid">
        <a href="/" class="navbar-brand">
            <img src="<?= base_url('assets/images'); ?>/logo.png" alt="AdminLTE Logo" class="brand-image img-circle" style="opacity: .8">
            <span class="brand-text font-weight-light">Putra E-Commerce</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/" class="nav-link">Home</a>
                </li>
            </ul>

            <form class="form-inline ml-0 ml-md-3" action="/" method="POST">
                <div class="input-group input-group-sm">
                    <input name="search" class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="badge badge-danger navbar-badge">Cart</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <a href="#" class="dropdown-item">
                            <div class="media">
                                <img src="<?= base_url('assets/images'); ?>/jamtangan.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nama Barang
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Deskripsi Barang</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                    <?php endfor; ?>
                    <a href="#" class="dropdown-item dropdown-footer">See All Carts</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" <?php if (logged_in()) : ?> data-toggle="dropdown" href="#" <?php else : ?> href="<?= base_url('/login'); ?>" <?php endif; ?>>
                    <i class="fas fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">Account</span>
                    <div class="dropdown-divider"></div>
                    <?php if (logged_in()) : ?>
                        <?php if (in_groups('penjual') || in_groups('pembeli')) : ?>
                            <a href="<?= base_url('/profile'); ?>" class="dropdown-item">
                                <i class="fas fa-user"></i> Profile
                            </a>
                        <?php endif; ?>
                        <?php if (in_groups('admin')) : ?>
                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url('/admin'); ?>" class="dropdown-item">
                                <i class="fas fa-cogs"></i> Dashboard
                            </a>
                        <?php endif; ?>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('/logout'); ?>" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    <?php endif; ?>
                </div>
            </li>
        </ul>
    </div>
</nav>