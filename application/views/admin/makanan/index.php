<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>admin"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Makanan & Minuman</li>
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
                    <h3 class="mb-0">Daftar Makanan & Minuman</h3>
                </div>
                <div class="col-lg-12">
                    <?= $this->session->flashdata('message'); ?>
                    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahmakananmodal"><i class="fa fa-plus"></i> Tambah Menu</button>
                    <div class="table-responsive">
                        <table class="table table-flush dataTable" id="datatable-id" role="grid" aria-describedby="datatable-basic_info">
                            <thead class="thead-dark">
                                <tr role="row">
                                    <th>No</th>
                                    <th>Nama Menu</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($makanan as $mk) {
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $mk['nama_menu'] ?></td>
                                        <td><?= $mk['kategori'] ?></td>
                                        <td><?php if ($mk['stok'] == 'Tersedia') { ?>
                                                <span class="badge badge-success">Tersedia</span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger">Tidak Tersedia</span>
                                            <?php } ?>
                                        </td>
                                        <td>Rp. <?= number_format($mk['harga'], 0, ',', '.')  ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>makanan/detail/<?= $mk['id_menu'] ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Detail</a>
                                            <a href="<?= base_url() ?>makanan/edit/<?= $mk['id_menu'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="<?= base_url() ?>makanan/delete/<?= $mk['id_menu'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus menu <?= $mk['nama_menu'] ?>? Jika anda menghapus menu ini maka gambar menu ini ikut terhapus.')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Menu -->
    <div class="modal fade" id="tambahmakananmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Menu Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url() ?>makanan/tambah" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Menu</label>
                                    <input type="text" class="form-control" placeholder="Masukkan nama menu" name="nama_menu" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Kategori</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="kategori">
                                        <option>Makanan</option>
                                        <option>Minuman</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Stok</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="stok">
                                        <option>Tersedia</option>
                                        <option>Tidak Tersedia</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Harga (Rp)</label>
                                    <input type="number" class="form-control" placeholder="Masukkan harga" name="harga" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Detail Menu</label>
                                    <textarea class="form-control" rows="5" placeholder="Masukkan detail menu" name="detail_menu" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Gambar Menu (Opsional)</label>
                                    <input type="file" class="form-control" id="gambar_menu" name="gambar_menu">
                                    <small class="form-text text-muted">Format: JPG, PNG, JPEG. Maks: 5MB</small>
                                    <div id="previewGambar" class="mt-2"></div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Menu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk menampilkan preview gambar
        function tampilkanPreviewGambar(event) {
            const previewContainer = document.getElementById('previewGambar');
            previewContainer.innerHTML = ''; // Bersihkan preview sebelumnya

            if (this.files && this.files.length > 0) {
                // Tentukan batas maksimal gambar (3)
                const maxGambar = 3;
                const filesToShow = Array.from(this.files).slice(0, maxGambar);

                // Buat wadah untuk preview
                const row = document.createElement('div');
                row.className = 'row mt-3';
                previewContainer.appendChild(row);

                // Tampilkan preview untuk setiap file
                filesToShow.forEach(function(file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.className = 'col-md-4 mb-3';

                        const card = document.createElement('div');
                        card.className = 'card';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'card-img-top';
                        img.alt = 'Preview Gambar Menu';

                        const cardBody = document.createElement('div');
                        cardBody.className = 'card-body p-2 text-center';

                        const fileName = document.createElement('small');
                        fileName.className = 'text-muted';
                        fileName.textContent = file.name.length > 20 ?
                            file.name.substring(0, 17) + '...' :
                            file.name;

                        cardBody.appendChild(fileName);
                        card.appendChild(img);
                        card.appendChild(cardBody);
                        col.appendChild(card);
                        row.appendChild(col);
                    };
                    reader.readAsDataURL(file);
                });

                // Tampilkan peringatan jika file terlalu banyak
                if (this.files.length > maxGambar) {
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-warning mt-2';
                    alertDiv.innerHTML = `
                <i class="fas fa-exclamation-triangle"></i> 
                Hanya ${maxGambar} gambar pertama yang akan diupload (maksimal ${maxGambar} gambar per menu).
            `;
                    previewContainer.appendChild(alertDiv);
                }

                // Validasi ukuran dan tipe file
                let isValid = true;
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                const maxSize = 5 * 1024 * 1024; // 5MB

                Array.from(this.files).forEach(file => {
                    if (!validTypes.includes(file.type)) {
                        isValid = false;
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'alert alert-danger mt-2';
                        alertDiv.innerHTML = `
                    <i class="fas fa-times-circle"></i> 
                    File "${file.name}" bukan format gambar yang valid. Hanya JPG, JPEG, dan PNG yang diperbolehkan.
                `;
                        previewContainer.appendChild(alertDiv);
                    }

                    if (file.size > maxSize) {
                        isValid = false;
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'alert alert-danger mt-2';
                        alertDiv.innerHTML = `
                    <i class="fas fa-times-circle"></i> 
                    File "${file.name}" terlalu besar. Ukuran maksimum adalah 5MB.
                `;
                        previewContainer.appendChild(alertDiv);
                    }
                });

                // Jika ada file yang tidak valid, kosongkan input file
                if (!isValid) {
                    this.value = '';
                }
            }
        }

        // Tambahkan event listener ke input file
        const inputGambarMenu = document.querySelector('input[name="gambar_menu"]');
        if (inputGambarMenu) {
            inputGambarMenu.addEventListener('change', tampilkanPreviewGambar);
        }
    });
</script>