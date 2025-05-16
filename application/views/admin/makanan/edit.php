<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                    <h3 class="mb-0">Edit Makanan & Minuman</h3>
                </div>
                <div class="col-lg-12">
                    <?= $this->session->flashdata('message'); ?>
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <?php
                    // Pastikan data menu tersedia
                    if (!empty($makanan)) {
                        $mk = $makanan[0]; // Ambil data menu pertama
                    ?>

                        <form action="<?= base_url() ?>makanan/prosesEdit" method="post" enctype="multipart/form-data" id="formEditMenu">
                            <input type="hidden" value="<?= $mk['id_menu'] ?>" name="id_menu">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_menu" class="form-control-label">Nama Menu</label>
                                        <input value="<?= $mk['nama_menu'] ?>" type="text" required class="form-control" id="nama_menu" name="nama_menu" placeholder="Nama Menu">
                                    </div>
                                    <div class="form-group">
                                        <label for="detail_menu" class="form-control-label">Detail Menu</label>
                                        <textarea rows="6" class="form-control" id="detail_menu" name="detail_menu" placeholder="Detail Menu" required><?= $mk['detail_menu'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori">Kategori</label>
                                        <select class="form-control" id="kategori" name="kategori">
                                            <option value="Makanan" <?php if ($mk['kategori'] == "Makanan") echo "selected"; ?>>Makanan</option>
                                            <option value="Minuman" <?php if ($mk['kategori'] == "Minuman") echo "selected"; ?>>Minuman</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="stok">Stok</label>
                                        <select class="form-control" id="stok" name="stok">
                                            <option value="Tersedia" <?php if ($mk['stok'] == "Tersedia") echo "selected"; ?>>Tersedia</option>
                                            <option value="Tidak Tersedia" <?php if ($mk['stok'] == "Tidak Tersedia") echo "selected"; ?>>Tidak Tersedia</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga" class="form-control-label">Harga</label>
                                        <input value="<?= $mk['harga'] ?>" type="number" min="0" required class="form-control" id="harga" name="harga" placeholder="Harga">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card shadow">
                                        <div class="card-header bg-white">
                                            <h4 class="mb-0">Gambar Menu</h4>
                                            <small class="text-muted">Maksimal 3 gambar per menu</small>
                                        </div>
                                        <div class="card-body">
                                            <?php if (!empty($gambar)): ?>
                                                <div class="row mb-4" id="existing-images-container">
                                                    <?php foreach ($gambar as $gb): ?>
                                                        <div class="col-md-6 mb-3" id="image-container-<?= $gb['id_gambar'] ?>">
                                                            <div class="card">
                                                                <img src="<?= base_url() ?>assets/dataresto/menu/<?= $gb['gambar'] ?>" class="card-img-top" alt="<?= $gb['gambar'] ?>">
                                                                <div class="card-body p-2">
                                                                    <div class="btn-group btn-group-sm w-100">
                                                                        <button type="button" class="btn btn-warning btn-replace-temp"
                                                                            data-id="<?= $gb['id_gambar'] ?>">
                                                                            <i class="fas fa-sync-alt"></i> Ganti
                                                                        </button>
                                                                        <button type="button" class="btn btn-danger btn-delete-temp"
                                                                            data-id="<?= $gb['id_gambar'] ?>">
                                                                            <i class="fas fa-trash"></i> Hapus
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php else: ?>
                                                <div class="text-center py-4 mb-3" id="no-images-message">
                                                    <i class="fas fa-image fa-4x text-muted mb-3"></i>
                                                    <p class="text-muted">Belum ada gambar untuk menu ini</p>
                                                </div>
                                            <?php endif; ?>

                                            <!-- Form untuk Tambah Gambar Baru -->
                                            <?php if ($jumlah_gambar < 3): ?>
                                                <div class="card" id="upload-new-images-card">
                                                    <div class="card-header bg-light">
                                                        <h5 class="mb-0">Tambah Gambar Baru</h5>
                                                        <small class="text-muted">Sisa slot: <?= 3 - $jumlah_gambar ?> gambar</small>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label>Upload Gambar Menu Baru</label>
                                                            <input type="file" class="form-control" name="gambar_menu[]" multiple id="newImages" accept="image/jpeg,image/png,image/jpg">
                                                            <small class="form-text text-muted">Format: JPG, PNG, JPEG. Maks: 5MB</small>
                                                        </div>
                                                        <div id="newImagesPreview" class="mt-2 row"></div>
                                                        <small class="text-muted">* Kosongkan jika tidak ingin menambah gambar baru</small>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="alert alert-info">
                                                    <i class="fas fa-info-circle"></i> Menu ini sudah memiliki maksimal 3 gambar. Hapus salah satu gambar untuk menambahkan yang baru.
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mb-3 mt-4">
                                <a href="<?= base_url() ?>makanan" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-success" id="btnSimpanPerubahan">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>

                        <!-- Modal untuk Ganti Gambar -->
                        <div class="modal fade" id="replaceImageModal" tabindex="-1" role="dialog" aria-labelledby="replaceImageModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="replaceImageModalLabel">Ganti Gambar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="replaceImageForm" method="post" enctype="multipart/form-data" action="<?= base_url() ?>makanan/replace_gambar">
                                        <div class="modal-body">
                                            <input type="hidden" id="replace_image_id" name="id_gambar">
                                            <input type="hidden" name="id_menu" value="<?= $mk['id_menu'] ?>">
                                            <div class="form-group">
                                                <label>Pilih Gambar Baru</label>
                                                <input type="file" class="form-control" id="replace_image_file" name="gambar_menu" required accept="image/jpeg,image/png,image/jpg">
                                                <small class="form-text text-muted">Format: JPG, PNG, JPEG. Maks: 5MB</small>
                                            </div>
                                            <div class="preview-container mt-2" id="preview-replace-container"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Ganti Sekarang</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Konfirmasi Hapus -->
                        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus gambar ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus Sekarang</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } else { ?>
                        <div class="alert alert-danger">
                            Data menu tidak ditemukan.
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const base_url = '<?= base_url() ?>';
        const id_menu = '<?= $mk['id_menu'] ?? '' ?>';
        const currentImageCount = <?= $jumlah_gambar ?? 0 ?>;
        let imageToDeleteId = null;

        // Preview gambar untuk replace
        document.getElementById('replace_image_file').addEventListener('change', function(e) {
            const previewContainer = document.getElementById('preview-replace-container');
            previewContainer.innerHTML = '';

            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('img-fluid', 'mt-2');
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Tombol untuk ganti gambar
        document.querySelectorAll('.btn-replace-temp').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const imageId = this.getAttribute('data-id');
                document.getElementById('replace_image_id').value = imageId;
                document.getElementById('preview-replace-container').innerHTML = '';
                $('#replaceImageModal').modal('show');
            });
        });

        // Form replace image submit
        document.getElementById('replaceImageForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const imageId = document.getElementById('replace_image_id').value;
            const fileInput = document.getElementById('replace_image_file');
            const idMenu = '<?= $mk['id_menu'] ?>';

            // Validasi file
            if (!fileInput.files || !fileInput.files[0]) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Silakan pilih file gambar terlebih dahulu'
                });
                return;
            }

            // Validasi tipe file
            const file = fileInput.files[0];
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!validTypes.includes(file.type)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Tipe File Tidak Valid!',
                    text: 'Hanya file JPG, JPEG, dan PNG yang diperbolehkan'
                });
                return;
            }

            // Validasi ukuran file (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ukuran File Terlalu Besar!',
                    text: 'Ukuran maksimal file adalah 5MB'
                });
                return;
            }

            // Tampilkan loading
            Swal.fire({
                title: 'Sedang mengganti gambar...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Buat form data baru
            const formData = new FormData();
            formData.append('id_gambar', imageId);
            formData.append('id_menu', idMenu);
            formData.append('gambar_menu', file);

            // Kirim dengan fetch API - PASTIKAN URL ENDPOINT BENAR
            fetch(`${base_url}makanan/replace_gambar/${imageId}/${idMenu}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    // Coba tangani berbagai kemungkinan tipe respons
                    const contentType = response.headers.get('content-type');

                    // Coba parsing JSON terlebih dahulu
                    return response.text().then(text => {
                        try {
                            return JSON.parse(text);
                        } catch (e) {
                            console.error('Gagal parsing JSON:', text);
                            throw new Error('Server tidak mengembalikan format JSON yang valid');
                        }
                    });
                })
                .then(data => {
                    $('#replaceImageModal').modal('hide');

                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message || 'Gambar berhasil diganti',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message || 'Gagal mengganti gambar'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    $('#replaceImageModal').modal('hide');

                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan!',
                        text: 'Gagal menghubungi server. Detail: ' + error.message
                    });
                });
        });

        // Tombol delete image
        document.querySelectorAll('.btn-delete-temp').forEach(function(btn) {
            btn.addEventListener('click', function() {
                imageToDeleteId = this.getAttribute('data-id');
                $('#confirmDeleteModal').modal('show');
            });
        });

        // Confirm delete button
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (imageToDeleteId) {
                Swal.fire({
                    title: 'Sedang menghapus gambar...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                fetch(`${base_url}makanan/hapus_gambar/${imageToDeleteId}/${id_menu}`, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        $('#confirmDeleteModal').modal('hide');

                        if (data.success) {
                            // Hapus elemen dari DOM
                            const imageContainer = document.getElementById(`image-container-${imageToDeleteId}`);
                            if (imageContainer) {
                                imageContainer.remove();
                            }

                            // Update UI jika tidak ada gambar tersisa
                            const remainingImages = document.querySelectorAll('#existing-images-container .col-md-6');
                            if (remainingImages.length === 0) {
                                // Tampilkan pesan tidak ada gambar
                                const noImagesDiv = document.createElement('div');
                                noImagesDiv.id = 'no-images-message';
                                noImagesDiv.className = 'text-center py-4 mb-3';
                                noImagesDiv.innerHTML = `
                                <i class="fas fa-image fa-4x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada gambar untuk menu ini</p>
                            `;
                                document.getElementById('existing-images-container').parentNode.insertBefore(
                                    noImagesDiv,
                                    document.getElementById('existing-images-container')
                                );
                                document.getElementById('existing-images-container').style.display = 'none';
                            }

                            // Tampilkan kartu upload jika kurang dari 3 gambar
                            if (document.getElementById('upload-new-images-card') === null && remainingImages.length < 3) {
                                const uploadCard = document.createElement('div');
                                uploadCard.id = 'upload-new-images-card';
                                uploadCard.className = 'card';
                                uploadCard.innerHTML = `
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Tambah Gambar Baru</h5>
                                    <small class="text-muted">Sisa slot: ${3 - remainingImages.length} gambar</small>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Upload Gambar Menu Baru</label>
                                        <input type="file" class="form-control" name="gambar_menu[]" multiple id="newImages" accept="image/jpeg,image/png,image/jpg">
                                        <small class="form-text text-muted">Format: JPG, PNG, JPEG. Maks: 5MB</small>
                                    </div>
                                    <div id="newImagesPreview" class="mt-2 row"></div>
                                    <small class="text-muted">* Kosongkan jika tidak ingin menambah gambar baru</small>
                                </div>
                            `;
                                document.querySelector('.card-body').appendChild(uploadCard);

                                // Tambahkan event listener untuk preview
                                document.getElementById('newImages').addEventListener('change', handleNewImagesPreview);
                            }

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Gambar berhasil dihapus',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Gagal menghapus gambar'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        $('#confirmDeleteModal').modal('hide');

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat menghapus gambar'
                        });
                    });
            }
        });

        // Preview untuk gambar baru
        function handleNewImagesPreview() {
            const preview = document.getElementById('newImagesPreview');
            preview.innerHTML = '';

            if (this.files) {
                // Cek batas jumlah gambar
                const existingImagesCount = document.querySelectorAll('#existing-images-container .col-md-6').length;
                const maxNewImages = 3 - existingImagesCount;

                // Tunjukkan hanya gambar yang bisa diupload (max 3 total)
                const filesToShow = Array.from(this.files).slice(0, maxNewImages);

                filesToShow.forEach(function(file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.classList.add('col-md-4', 'mb-2');

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('img-fluid', 'img-thumbnail');

                        col.appendChild(img);
                        preview.appendChild(col);
                    }
                    reader.readAsDataURL(file);
                });

                // Tampilkan peringatan jika ada gambar yang tidak akan diupload
                if (this.files.length > maxNewImages) {
                    const warningDiv = document.createElement('div');
                    warningDiv.className = 'col-12 mt-2';
                    warningDiv.innerHTML = `
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> 
                            Hanya ${maxNewImages} gambar pertama yang akan diupload (maksimal 3 gambar per menu).
                        </div>
                    `;
                    preview.appendChild(warningDiv);
                }
            }
        }

        const newImagesInput = document.getElementById('newImages');
        if (newImagesInput) {
            newImagesInput.addEventListener('change', handleNewImagesPreview);
        }

        // Form validation dan submit
        document.getElementById('formEditMenu').addEventListener('submit', function(e) {
            Swal.fire({
                title: 'Menyimpan perubahan...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Form akan disubmit secara normal ke controller
        });
    });
</script>