<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>admin"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>makanan">Makanan & Minuman</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail Menu</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Detail Menu</h3>
                </div>
                <div class="col-lg-12">
                    <?= $this->session->flashdata('message'); ?>
                    <?php
                    foreach ($makanan as $mk) {
                    ?>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="card shadow">
                                    <div class="card-header bg-white">
                                        <h4 class="mb-0">Gambar Menu</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php if (!empty($gambar)) { ?>
                                            <div id="carouselExample" class="carousel slide" data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                    <?php for ($i = 0; $i < count($gambar); $i++) { ?>
                                                        <li data-target="#carouselExample" data-slide-to="<?= $i ?>" class="<?= ($i == 0) ? 'active' : '' ?>"></li>
                                                    <?php } ?>
                                                </ol>
                                                <div class="carousel-inner">
                                                    <?php $active = true;
                                                    foreach ($gambar as $gb) { ?>
                                                        <div class="carousel-item <?= ($active) ? 'active' : '' ?>">
                                                            <img class="d-block w-100" src="<?= base_url() ?>assets/dataresto/menu/<?= $gb['gambar'] ?>" alt="Gambar <?= $mk['nama_menu'] ?>">
                                                        </div>
                                                    <?php $active = false;
                                                    } ?>
                                                </div>
                                                <?php if (count($gambar) > 1) { ?>
                                                    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        <?php } else { ?>
                                            <div class="text-center py-5">
                                                <i class="fas fa-image fa-4x text-muted mb-3"></i>
                                                <p class="text-muted">Belum ada gambar untuk menu ini</p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card shadow">
                                    <div class="card-header bg-white">
                                        <h4 class="mb-0">Informasi Menu</h4>
                                    </div>
                                    <div class="card-body">
                                        <h2 class="mb-4 font-weight-bold"><?= $mk['nama_menu'] ?></h2>

                                        <div class="mb-4">
                                            <span class="badge badge-pill badge-primary"><?= $mk['kategori'] ?></span>
                                            <?php if ($mk['stok'] == 'Tersedia') { ?>
                                                <span class="badge badge-pill badge-success">Tersedia</span>
                                            <?php } else { ?>
                                                <span class="badge badge-pill badge-danger">Tidak Tersedia</span>
                                            <?php } ?>
                                        </div>

                                        <div class="mb-4">
                                            <h5 class="text-muted mb-2">Harga</h5>
                                            <h3 class="text-primary">Rp. <?= number_format($mk['harga'], 0, ',', '.') ?></h3>
                                        </div>

                                        <div class="mb-4">
                                            <h5 class="text-muted mb-2">Deskripsi</h5>
                                            <p style="white-space: pre-line; text-align: justify;"><?= $mk['detail_menu'] ?></p>
                                        </div>

                                        <div class="mt-5">
                                            <a href="<?= base_url() ?>makanan" class="btn btn-secondary">
                                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                                            </a>
                                            <a href="<?= base_url() ?>makanan/edit/<?= $mk['id_menu'] ?>" class="btn btn-warning">
                                                <i class="fas fa-edit mr-2"></i> Edit Menu
                                            </a>
                                            <a href="<?= base_url() ?>makanan/delete/<?= $mk['id_menu'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus menu <?= $mk['nama_menu'] ?>? Jika anda menghapus menu ini maka gambar menu ini ikut terhapus.')" class="btn btn-danger">
                                                <i class="fas fa-trash mr-2"></i> Hapus Menu
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>