<?= $this->extend('frontend/index'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-header">
                            <h5>Detail Toko</h5>
                        </div>
                        <div class="card-body row">
                            <div class="col-lg-3">
                                <img src="<?= base_url('assets/images/merchants') . "/" . $merchant['store_name'] . "/" . $merchant['store_logo']; ?>" alt="" class="img-thumbnail">
                            </div>
                            <div class="col-lg-9">
                                <table>
                                    <tbody>
                                        <tr>
                                            <th colspan="3">
                                                <h3><b><?= $merchant['store_name']; ?></b></h3>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <p class="m-0 p-0">Alamat Toko</p>
                                            </th>
                                            <td>:</td>
                                            <td>
                                                <p class="m-0 p-0"><?= $merchant['store_address']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                <p class="m-0 p-0">Status</p>
                                            </th>
                                            <td>:</td>
                                            <td>
                                                <p class="m-0 p-0">
                                                    <?php
                                                    $statusMerchant = "";
                                                    $iconstatusMerchant = "";
                                                    $statusverifyMerchant = "";
                                                    $iconstatusverifyMerchant = "";

                                                    switch ($merchant['merchant_status']) {
                                                        case 'active':
                                                            $statusMerchant = "Aktif";
                                                            $iconstatusMerchant = "<i class='fas fa-circle' style='color: green;'></i>";
                                                            break;
                                                        case 'banned':
                                                            $statusMerchant = "<b>Diblokir</b>";
                                                            $iconstatusMerchant = "<i class='fas fa-ban' style='color: red;'></i>";
                                                            break;
                                                        case 'suspended':
                                                            $statusMerchant = "<em>Menunggu Verifikasi</em>";
                                                            $iconstatusMerchant = "<i class='far fa-clock' style='color: grey;'></i>";
                                                            break;
                                                        default:
                                                            $statusMerchant = "<em>Menunggu Verifikasi</em>";
                                                            $iconstatusMerchant = "<i class='far fa-clock' style='color: grey;'></i>";
                                                            break;
                                                    }

                                                    switch ($merchant['verified']) {
                                                        case 'true':
                                                            $statusverifyMerchant = "Verifikasi";
                                                            $iconstatusverifyMerchant = "<i class='fas fa-check-circle' style='color: blue;'></i>";
                                                            break;
                                                        case 'false':
                                                            $statusverifyMerchant = "Belum Diverifikasi";
                                                            $iconstatusverifyMerchant = "<i class='fas fa-times-circle' style='color: red;'></i>";
                                                            break;
                                                        default:
                                                            $statusverifyMerchant = "Belum Diverifikasi";
                                                            $iconstatusverifyMerchant = "<i class='fas fa-times-circle' style='color: red;'></i>";
                                                            break;
                                                    }
                                                    ?>
                                                    <?= $iconstatusMerchant . " " . $statusMerchant; ?> || <?= $iconstatusverifyMerchant . " " . $statusverifyMerchant; ?>
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-pills nav-justified" id="myTab" role="tablist">
                                <?php $i = 0; ?>
                                <?php foreach ($categories as $category) : ?>
                                    <?php
                                    $strtolower = mb_strtolower($category['category_name'], 'UTF-8');
                                    $explodestr = explode(" ", $strtolower);
                                    $initcategory = array();
                                    foreach ($explodestr as $exp) {
                                        if ($exp != "&") {
                                            array_push($initcategory, $exp);
                                        }
                                    }
                                    $realcategory = implode($initcategory);
                                    ?>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link <?= $i == 0 ? 'active' : '' ?>" id="<?= $realcategory; ?>-tab" data-bs-toggle="tab" data-bs-target="#<?= $realcategory; ?>" type="button" role="tab" aria-controls="<?= $realcategory; ?>" aria-selected="true"><?= $category['category_name']; ?></button>
                                    </li>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="card-body tab-content" id="myTabContent">
                            <?php $i = 0; ?>
                            <?php foreach ($categories as $category) : ?>
                                <?php
                                $strtolower = mb_strtolower($category['category_name'], 'UTF-8');
                                $explodestr = explode(" ", $strtolower);
                                $initcategory = array();
                                foreach ($explodestr as $exp) {
                                    if ($exp != "&") {
                                        array_push($initcategory, $exp);
                                    }
                                }
                                $realcategory = implode($initcategory);
                                ?>
                                <div class="tab-pane fade show <?= $i == 0 ? 'active' : '' ?>" id="<?= $realcategory; ?>" role="tabpanel" aria-labelledby="<?= $realcategory; ?>-tab">
                                    <?php $jumlahproduk = 0; ?>
                                    <?php foreach ($products as $product) : ?>
                                        <?php if ($category['id'] == $product['category_id']) : ?>
                                            <?php $jumlahproduk++; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                    <div class="row <?= $jumlahproduk > 0 ? 'row-cols-1 row-cols-md-6 g-4' : 'justify-content-center'; ?>">
                                        <?php if ($jumlahproduk > 0) : ?>
                                            <?php foreach ($products as $product) : ?>
                                                <div class="col">
                                                    <div class="card card-primary card-outline h-100 product-card">
                                                        <div class="card-header p-0 mb-1">
                                                            <img src="<?= base_url('assets/images/merchants'); ?>/<?= $product['product_thumbnail']; ?>" class="img-fluid" alt="">
                                                        </div>

                                                        <div class="card-body px-2 py-0">
                                                            <!-- Max Char 8 -->
                                                            <div class="name mb-1">
                                                                <h5><?= strlen($product['product_name']) >= 57 ? substr($product['product_name'], 0, 57) . "..." : $product['product_name']; ?></h5>
                                                            </div>

                                                            <!-- Max Char 15 -->
                                                            <div class="desc mb-3">
                                                                <p class="text-muted"><?= strlen($product['product_description']) > 50 ? substr($product['product_description'], 0, 50) . "..." : $product['product_description']; ?></p>
                                                            </div>
                                                            <div class="price row">
                                                                <div class="col">
                                                                    <span class="badge bg-primary">Stok Produk : <?= $product['stock']; ?></span>
                                                                </div>
                                                                <div class="col py-1">
                                                                    <h6 class="text-end p-0 m-0">Rp<?= $product['product_price']; ?></h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer p-0">
                                                            <div class="row">
                                                                <div class="col pe-0">
                                                                    <form action="/store" method="POST" class="d-inline">
                                                                        <?= csrf_field(); ?>
                                                                        <input type="hidden" name="id_merchant" value="<?= $product['merchant_id']; ?>">
                                                                        <button class="btn btn-warning visitstorebtn"><i class="fas fa-store"></i></button>
                                                                    </form>
                                                                </div>
                                                                <div class="col ps-0">
                                                                    <button class="btn btn-success addtocartbtn" type="button" data-bs-toggle="modal" data-bs-target="#modalAddtoCart<?= $product['id']; ?>"><i class="fas fa-cart-plus"></i></button>

                                                                    <div class="modal fade" id="modalAddtoCart<?= $product['id']; ?>" tabindex="-1" aria-labelledby="modalAddtoCart<?= $product['id']; ?>Label" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered">
                                                                            <div class="modal-content">
                                                                                <form action="/produk/addtocart" method="POST" class="d-inline">
                                                                                    <?= csrf_field(); ?>
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Jumlah Produk</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <input type="hidden" name="id_product" value="<?= $product['id']; ?>">
                                                                                        <input type="hidden" name="id_merchant" value="<?= $product['merchant_id']; ?>">
                                                                                        <div class="input-group mb-3">
                                                                                            <button class="btn btn-success" type="button" id="button-addon1" onclick="incrementVal(<?= $product['stock']; ?>);"><b>+</b></button>
                                                                                            <input type="number" class="form-control text-center" placeholder="Masukkan jumlah produk" aria-describedby="button-addon1" name="jumlahProduk" id="jumlahProduk" value="0">
                                                                                            <button class="btn btn-success" type="button" id="button-addon1" onclick="decrementVal(<?= $product['stock']; ?>);"><b>-</b></button>
                                                                                        </div>
                                                                                        <p class="text-center" style="color:red;"><?= $product['stock'] == 0 ? 'Produk yang anda pilih telah habis terjual' : ''; ?></p>
                                                                                        <script>
                                                                                            const incrementVal = (maxValue) => {
                                                                                                const prevValue = document.getElementById('jumlahProduk').value;
                                                                                                let result = parseInt(prevValue) + 1;
                                                                                                if (result <= maxValue) {
                                                                                                    document.getElementById('jumlahProduk').value = result;
                                                                                                }
                                                                                            }
                                                                                            const decrementVal = (maxValue) => {
                                                                                                const prevValue = document.getElementById('jumlahProduk').value;
                                                                                                let result = parseInt(prevValue) - 1;
                                                                                                if (result >= 0 && result <= maxValue) {
                                                                                                    document.getElementById('jumlahProduk').value = result;
                                                                                                }
                                                                                            }
                                                                                        </script>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn btn-primary" <?= $product['stock'] == 0 ? 'disabled' : ''; ?>>Simpan</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <img src="<?= base_url('assets/images'); ?>/no-product.png" class="img-fluid" alt="">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<?= $this->endSection(); ?>