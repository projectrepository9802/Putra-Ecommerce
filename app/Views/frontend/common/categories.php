<div class="card">
    <div class="card-header">
        <h3 class="card-title">Kategori</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
            <?php foreach ($categories as $category) : ?>
                <li class="nav-item active">
                    <a href="/category/<?= $category['category_slug']; ?>" class="nav-link">
                        <i class="<?= $category['icon']; ?>"></i> <?= $category['category_name']; ?>
                        <span class="badge bg-primary float-right"><?= $category['total_product']; ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>