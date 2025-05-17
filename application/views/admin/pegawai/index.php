<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>admin"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kelola Pegawai</li>
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
                    <h3 class="mb-0">Kelola Pegawai</h3>
                </div>
                <div class="col-lg-12">
                    <?= $this->session->flashdata('message'); ?>
                    <?php if ($this->session->flashdata('error')) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $this->session->flashdata('error') ?>
                        </div>
                    <?php
                    } ?>
                    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahpegawaimodal"><i class="fa fa-plus"></i> Tambah Pegawai</button>
                    <div class="table-responsive">
                        <table class="table table-flush dataTable" id="datatable-id" role="grid" aria-describedby="datatable-basic_info">
                            <thead class="thead-dark">
                                <tr role="row">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Nomor Telepon</th>
                                    <th>Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($meja as $m) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $m['nama'] ?></td>
                                        <td><?= $m['email'] ?></td>
                                        <td><?= $m['telepon'] ?></td>
                                        <td><?= $m['jabatan'] ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>admin/detail_pegawai/<?= $m['id_pegawai'] ?>" class="btn btn-sm btn-info">Detail</a>
                                            <button data-toggle="modal" data-target="#editpegawaimodal" onclick="edit_pegawai(<?= $m['id_pegawai'] ?>)" class="btn btn-sm btn-primary">Edit</button>
                                            <?php
                                            if ($m['jabatan'] != "admin") {
                                            ?>
                                                <a href="<?= base_url() ?>admin/hapus_pegawai/<?= $m['id_pegawai'] ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Pegawai <?= $m['nama'] ?>?');" class="btn btn-sm btn-danger">Hapus</a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pegawai -->
<div class="modal fade" id="tambahpegawaimodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>admin/tambah_pegawai" method="POST" id="formTambahPegawai" onsubmit="return validatePassword()">
                    <div class="form-group">
                        <label>Nama Pegawai</label>
                        <input type="text" class="form-control" placeholder="Ahmad Surbakti" name="nama" required>
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="ahmadsurbakti@gmail.com" name="email" required>
                        <label>Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" placeholder="minimum 5 karakter" name="password" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="fa fa-eye"></i></button>
                            </div>
                        </div>
                        <small class="form-text text-muted">Password minimal 5 karakter</small>
                        <label>Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin" required>
                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                            <option>Laki-laki</option>
                            <option>Perempuan</option>
                        </select>
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="Jl. Untung surapati, Ledok Kulon, Bojonegoro" name="alamat" required>
                        <label>Telepon</label>
                        <input type="text" class="form-control" placeholder="081258980012" name="telepon" required>
                        <label>Jabatan</label>
                        <select class="form-control" name="jabatan" required>
                            <option value="" selected disabled>Pilih Jabatan</option>
                            <option value="admin">Admin</option>
                            <option value="pegawai">Pegawai</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Pegawai -->
<div class="modal fade" id="editpegawaimodal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Pegawai <span id="edit_nama_title"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>admin/edit_pegawai" method="POST" id="formEditPegawai" onsubmit="return validateEditPassword()">
                    <div class="form-group">
                        <input type="hidden" id="edit_id_pegawai" name="id_pegawai" required>
                        <label>Nama Pegawai</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama" required>
                        <label>Email</label>
                        <input type="text" class="form-control" id="edit_email" name="email" required>
                        <label>Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="edit_password" placeholder="Kosongkan jika tidak ingin mengubah password" name="password">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="toggleEditPassword"><i class="fa fa-eye"></i></button>
                            </div>
                        </div>
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password. Jika diisi, minimal 5 karakter.</small>
                        <label>Jenis Kelamin</label>
                        <select class="form-control" id="edit_jenis_kelamin" name="jenis_kelamin" required>
                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <label>Alamat</label>
                        <input type="text" class="form-control" id="edit_alamat" name="alamat" required>
                        <label>Telepon</label>
                        <input type="text" class="form-control" id="edit_telepon" name="telepon" required>
                        <label>Jabatan</label>
                        <select class="form-control" id="edit_jabatan" name="jabatan" required>
                            <option value="" selected disabled>Pilih Jabatan</option>
                            <option value="admin">Admin</option>
                            <option value="pegawai">Pegawai</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi validasi password untuk form tambah
    function validatePassword() {
        var password = document.getElementById("password").value;
        if (password.length < 5) {
            alert("Password harus minimal 5 karakter!");
            return false;
        }
        return true;
    }

    // Fungsi validasi password untuk form edit
    function validateEditPassword() {
        var password = document.getElementById("edit_password").value;
        if (password !== "" && password.length < 5) {
            alert("Password harus minimal 5 karakter!");
            return false;
        }
        return true;
    }

    function edit_pegawai(id) {
        $.ajax({
            type: 'GET', // Ganti menjadi GET karena kita hanya mengambil data
            url: '<?= base_url() ?>admin/get_pegawai_by_id/' + id,
            dataType: 'json',
            success: function(hasil) {
                // Pastikan console.log untuk debugging
                console.log("Data yang diterima:", hasil);

                // Pengecekan data valid
                if (hasil && !hasil.error) {
                    // Isi form dengan data yang diterima
                    document.getElementById("edit_id_pegawai").value = hasil.id_pegawai;
                    document.getElementById("edit_nama").value = hasil.nama;
                    document.getElementById("edit_email").value = hasil.email;
                    document.getElementById("edit_alamat").value = hasil.alamat;
                    document.getElementById("edit_telepon").value = hasil.telepon;

                    // Set selected options untuk dropdown
                    document.getElementById("edit_jenis_kelamin").value = hasil.jenis_kelamin;
                    document.getElementById("edit_jabatan").value = hasil.jabatan;

                    // Tambahkan nama di judul modal
                    $('#edit_nama_title').html(hasil.nama);
                } else {
                    alert("Data pegawai tidak lengkap atau tidak ditemukan");
                }
            },
            error: function(xhr, status, error) {
                // Tambahkan error handling
                console.error("Error:", error);
                console.error("Status:", status);
                console.error("Response:", xhr.responseText);
                alert("Terjadi kesalahan saat mengambil data pegawai");
            }
        });
    }

    // Fungsi untuk toggle password visibility
    $(document).ready(function() {
        // Toggle untuk form tambah
        $("#togglePassword").click(function() {
            var passwordField = document.getElementById("password");
            var icon = $(this).find("i");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                passwordField.type = "password";
                icon.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });

        // Toggle untuk form edit
        $("#toggleEditPassword").click(function() {
            var passwordField = document.getElementById("edit_password");
            var icon = $(this).find("i");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                passwordField.type = "password";
                icon.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });

        // Inisialisasi DataTable dengan penomoran yang benar
        $('#datatable-id').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json"
            }
        });
    });
</script>