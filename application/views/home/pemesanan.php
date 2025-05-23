<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Pemesanan Menu</h2>
        <ol>
          <li><a href="<?= base_url() ?>">Home</a></li>
          <li>Pemesanan Menu</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->

  <!-- Bagian Visualisasi Meja - Tempatkan ini setelah breadcrumbs dan sebelum formulir pemesanan -->
  <section id="visualisasi-meja" class="visualisasi-meja pb-2">
    <div class="container">
      <div class="section-title">
        <h2>Visualisasi Ketersediaan Meja</h2>
        <p>Silakan pilih meja yang tersedia (warna hijau)</p>
      </div>

      <div class="row">
        <!-- Area Indoor -->
        <div class="col-md-6 mb-4">
          <div class="card">
            <div class="card-header">
              <h5 class="mb-0">Area Indoor</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <?php foreach ($meja_indoor as $meja) : ?>
                  <div class="col-4 col-md-3 col-lg-2 mb-3">
                    <div class="text-center">
                      <div class="meja-seat <?= $meja['status_tersedia'] == 1 ? 'tersedia' : 'tidak-tersedia' ?>"
                        data-id="<?= $meja['id_meja'] ?>"
                        data-nomor="<?= $meja['nomor_meja'] ?>"
                        data-kapasitas="<?= $meja['kapasitas_meja'] ?>"
                        data-status="<?= $meja['status_tersedia'] ?>"
                        <?= $meja['status_tersedia'] == 1 ? 'onclick="pilihMeja(this)"' : '' ?>>
                        <span class="nomor-meja"><?= $meja['nomor_meja'] ?></span>
                        <span class="kapasitas-meja"><?= $meja['kapasitas_meja'] ?> org</span>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>

        <!-- Area Outdoor -->
        <div class="col-md-6 mb-4">
          <div class="card">
            <div class="card-header">
              <h5 class="mb-0">Area Outdoor</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <?php foreach ($meja_outdoor as $meja) : ?>
                  <div class="col-4 col-md-3 col-lg-2 mb-3">
                    <div class="text-center">
                      <div class="meja-seat <?= $meja['status_tersedia'] == 1 ? 'tersedia' : 'tidak-tersedia' ?>"
                        data-id="<?= $meja['id_meja'] ?>"
                        data-nomor="<?= $meja['nomor_meja'] ?>"
                        data-kapasitas="<?= $meja['kapasitas_meja'] ?>"
                        data-status="<?= $meja['status_tersedia'] ?>"
                        <?= $meja['status_tersedia'] == 1 ? 'onclick="pilihMeja(this)"' : '' ?>>
                        <span class="nomor-meja"><?= $meja['nomor_meja'] ?></span>
                        <span class="kapasitas-meja"><?= $meja['kapasitas_meja'] ?> org</span>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Keterangan status meja -->
      <div class="row mb-4">
        <div class="col-12">
          <div class="d-flex justify-content-center">
            <div class="mr-4">
              <span class="status-indicator tersedia"></span> Tersedia
            </div>
            <div>
              <span class="status-indicator tidak-tersedia"></span> Tidak Tersedia
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ======= Contact Us Section ======= -->
  <section id="contact-us" class="contact-us">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <h3>Formulir Pemesanan Menu</h3>
          <p>Isi data dengan lengkap dan benar</p>
          <div class="form-group mb-2">
            <label for="nama">Nama Panggilan/Lengkap</label>
            <small class="form-text" style="color: red;">*Wajib Diisi</small>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Panggilan/Lengkap" required onchange="updateNamaNomorHP()">
            <div class="invalid-feedback">Nama harus diisi!</div>
          </div>
          <div class="form-group mb-2">
            <label for="no_hp">Nomor HP</label>
            <small class="form-text" style="color: red;">*Wajib Diisi</small>
            <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Nomor HP" required onchange="updateNamaNomorHP()">
            <div class="invalid-feedback">Nomor HP harus diisi!</div>
          </div>
          <div class="form-group mb-2">
            <label>Tanggal Pemesanan</label>
            <small class="form-text" style="color: red;">*Terisi Otomatis</small>
            <?php
            // Mengatur zona waktu ke Asia/Jakarta (Indonesia)
            date_default_timezone_set('Asia/Jakarta');

            // Mendapatkan tanggal hari ini dalam format Y-m-d (YYYY-MM-DD)
            $today = date("Y-m-d");

            // Format tanggal untuk tampilan (contoh: 18 April 2025)
            $tanggal_tampilan = date("d F Y");
            ?>
            <!-- Input tersembunyi untuk menyimpan nilai tanggal -->
            <input type="hidden" name="tanggal_pemesanan" id="tanggal_pemesanan" value="<?= $today; ?>">

            <!-- Tampilan tanggal yang tidak bisa diubah -->
            <input type="text" class="form-control" value="<?= $tanggal_tampilan; ?>" readonly>
          </div>
          <div class="form-group mb-2">
            <label for="id_meja">Silakan Pilih Nomor Meja</label>
            <small class="form-text" style="color: red;">*Wajib Dipilih</small>
            <select class="form-control" id="id_meja" name="id_meja" onchange="tambah_meja(this.value)" required>
            </select>
            <div class="invalid-feedback">Nomor meja harus dipilih!</div>
          </div>
          <br>
          <h4><i class="fa fa-utensils"></i> Buku Menu</h4>
          <p>Pilih menu dan isi jumlah pemesanan</p>
          <div class="form-group mb-2">
            <label for="id_menu">Pilih Menu Yang Ingin Dipesan</label>
            <small class="form-text" style="color: red;">*Wajib Dipilih</small>
            <select class="select2bs4 form-control" id="id_menu" name="id_menu" required>
              <option disabled selected value="">Pilih Menu</option>
            </select>
            <div class="invalid-feedback">Menu harus dipilih!</div>
          </div>
          <div class="form-group mb-2">
            <label for="jumlah_pesanan">Jumlah Pesanan</label>
            <small class="form-text" style="color: red;">*Wajib Diisi</small>
            <input type="number" min="1" class="form-control" id="jumlah_pesanan" name="jumlah_pesanan" placeholder="Jumlah Pesanan" required>
            <div class="invalid-feedback">Jumlah pesanan harus diisi!</div>
          </div>
          <br>
          <div class="text-center d-grid gap-2 col-md-4 mx-auto">
            <button type="button" id="btn_tambah_menu" class="btn btn-success" onclick="tambah_menu()">Tambah Menu</button>
            <a href="<?= base_url() ?>" class="btn btn-secondary"><i class="fa fa-home"></i> Beranda</a>
          </div>
        </div>
        <div class="col-lg-6">
          <h3 id="judul_detail">Detail Pesanan
            <hr>
          </h3>
          <div class="row">
            <div class="col-lg-12">
              <form id="pesananForm" action="<?= base_url() ?>home/tambahPesanan" method="POST" onsubmit="return validateForm()">
                <span id="daftar">
                  <div id="keterangan_nama_nomor_hp">
                  </div>
                  <div id="keterangan_tanggal_dipilih">
                  </div>
                  <div id="keterangan_meja_dipilih">
                  </div>
                  <div class="row">
                    <h4 id="judul_menu">
                      <hr>
                      Menu Yang Dipesan
                    </h4>
                    <div class="col-lg-6" id="daftar_menu_dipesan">
                    </div>
                    <div class="col-lg-6" id="daftar_harga_dipesan">
                    </div>
                    <div class="col-lg-12 mt-1" id="total_harga">
                    </div>
                  </div>
                </span>
                <button class="btn btn-primary mt-2" id="tombol_booking" type="submit">Pesan Sekarang!</button>
              </form>
            </div>
          </div>
        </div>
      </div>
  </section><!-- End Contact Us Section -->

  <!-- CSS untuk Visualisasi Meja -->
  <style>
    .meja-seat {
      width: 100%;
      aspect-ratio: 1/1;
      border-radius: 8px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: white;
      font-weight: bold;
      transition: all 0.3s ease;
    }

    .tersedia {
      background-color: #2ecc71;
      box-shadow: 0 4px 8px rgba(46, 204, 113, 0.3);
      cursor: pointer;
    }

    .tersedia:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 12px rgba(46, 204, 113, 0.5);
    }

    .tidak-tersedia {
      background-color: #e74c3c;
      box-shadow: 0 4px 8px rgba(231, 76, 60, 0.3);
      opacity: 0.7;
      cursor: not-allowed;
    }

    .nomor-meja {
      font-size: 1.2rem;
    }

    .kapasitas-meja {
      font-size: 0.8rem;
      opacity: 0.9;
    }

    .status-indicator {
      display: inline-block;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      margin-right: 5px;
      vertical-align: middle;
    }

    .status-indicator.tersedia {
      background-color: #2ecc71;
    }

    .status-indicator.tidak-tersedia {
      background-color: #e74c3c;
    }

    .meja-selected {
      border: 3px solid #3498db;
      transform: scale(1.1);
      box-shadow: 0 6px 12px rgba(52, 152, 219, 0.5);
    }

    .card {
      border-radius: 8px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .card-header {
      background-color: #f8f9fa;
      border-bottom: 1px solid #e9ecef;
      padding: 12px 15px;
      font-weight: bold;
    }
  </style>
</main><!-- End #main -->

<script>
  $(document).ready(function() {
    // Awalnya sembunyikan beberapa elemen
    resetMenuState();

    // Nonaktifkan tombol tambah menu hingga meja dipilih
    disableTambahMenuButton();

    document.getElementById("judul_menu").style.display = "none";
    document.getElementById("judul_detail").style.display = "none";
    document.getElementById("tombol_booking").style.display = "none";
    document.getElementById("daftar_harga_dipesan").style.display = "none";
    document.getElementById("daftar_menu_dipesan").style.display = "none";

    // Ambil data meja tersedia saat halaman dimuat
    getMejaTersedia();

    // Tambahkan ini: Perbarui informasi tanggal
    updateTanggalPemesanan();
  });

  // Tambahkan fungsi untuk memperbarui informasi tanggal
  function updateTanggalPemesanan() {
    let tanggal = document.getElementById("tanggal_pemesanan").value;

    // Format tanggal untuk tampilan: dari YYYY-MM-DD menjadi DD/MM/YYYY
    let parts = tanggal.split('-');
    let formattedDate = parts[2] + '/' + parts[1] + '/' + parts[0];

    // Update informasi tanggal di detail pesanan
    let isinyatanggal = `
  <b>Tanggal Pemesanan</b> = ${formattedDate}
  <input type="hidden" name="hidden_tanggal_reservasi" value="${tanggal}"> 
  `;
    $('#keterangan_tanggal_dipilih').html(isinyatanggal);
  }

  // Fungsi untuk menonaktifkan tombol tambah menu
  function disableTambahMenuButton() {
    const btnTambahMenu = document.getElementById("btn_tambah_menu");
    btnTambahMenu.disabled = true;
    btnTambahMenu.classList.add("btn-secondary");
    btnTambahMenu.classList.remove("btn-success");
    btnTambahMenu.title = "Silakan pilih meja terlebih dahulu";
  }

  // Fungsi untuk mengaktifkan tombol tambah menu
  function enableTambahMenuButton() {
    const btnTambahMenu = document.getElementById("btn_tambah_menu");
    btnTambahMenu.disabled = false;
    btnTambahMenu.classList.remove("btn-secondary");
    btnTambahMenu.classList.add("btn-success");
    btnTambahMenu.title = "";
  }

  // Fungsi untuk memeriksa apakah meja sudah dipilih
  function isMejaSelected() {
    return document.getElementById('keterangan_meja_dipilih').innerHTML.trim() !== "";
  }

  // Fungsi untuk mereset status menu
  function resetMenuState() {
    document.getElementById("id_menu").setAttribute("disabled", "disabled");
    document.getElementById("jumlah_pesanan").setAttribute("disabled", "disabled");
  }

  // Fungsi untuk memformat angka menjadi format Rupiah
  function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID').format(angka);
  }

  // Fungsi validasi form sebelum submit
  function validateForm() {
    // Validasi nama
    if (document.getElementById('nama').value === "") {
      alert("Nama harus diisi!");
      document.getElementById('nama').focus();
      return false;
    }

    // Validasi nomor HP
    if (document.getElementById('no_hp').value === "") {
      alert("Nomor HP harus diisi!");
      document.getElementById('no_hp').focus();
      return false;
    }

    // Validasi meja
    if (!isMejaSelected()) {
      alert("Silakan pilih nomor meja!");
      document.getElementById('id_meja').focus();
      return false;
    }

    // Validasi menu (setidaknya satu menu harus dipilih)
    if (menu_total < 1) {
      alert("Minimal satu menu harus dipilih!");
      return false;
    }

    // Konfirmasi pemesanan
    return confirm('Apakah data dan pesanan anda sudah benar?');
  }

  // Fungsi untuk memperbarui nama dan nomor HP di detail pesanan
  function updateNamaNomorHP() {
    if (document.getElementById('nama').value === "") {
      return; // Jangan lakukan apa-apa jika nama kosong
    }

    // Periksa nomor HP, jika kosong, tampilkan pesan
    if (document.getElementById('no_hp').value === "") {
      var nomorhp = "-";
    } else {
      var nomorhp = document.getElementById('no_hp').value;
    }

    let namakustomer = document.getElementById('nama').value;
    let res = namakustomer.toUpperCase();
    let res2 = res.replace(/[^\w\s]/gi, '');
    let final_nama = res2.replace(/\s/g, '');

    let isinyanamanope = `<b>Nama/Nomor HP</b> = ${document.getElementById('nama').value} | ${nomorhp}
  <input type="hidden" name="hidden_nama_clean" value="${final_nama}"> 
  <input type="hidden" name="hidden_nama_pemesan" value="${document.getElementById('nama').value}"> 
  <input type="hidden" name="hidden_nomor_hp" value="${document.getElementById('no_hp').value}">
  `;
    $('#keterangan_nama_nomor_hp').html(isinyanamanope);

    // Tampilkan judul detail jika sudah ada nama
    document.getElementById("judul_detail").style.display = "";

    // Perbarui status menu berdasarkan pilihan meja
    updateMenuAccessibility();
  }

  // Fungsi untuk memperbarui akses menu berdasarkan status meja
  function updateMenuAccessibility() {
    if (isMejaSelected()) {
      // Meja sudah dipilih, aktifkan menu dan jumlah pesanan
      document.getElementById("id_menu").removeAttribute("disabled");
      document.getElementById("jumlah_pesanan").removeAttribute("disabled");
      enableTambahMenuButton();
    } else {
      // Meja belum dipilih, nonaktifkan menu dan jumlah pesanan
      resetMenuState();
      disableTambahMenuButton();
    }
  }

  // Fungsi untuk mendapatkan meja yang tersedia
  // Modifikasi fungsi getMejaTersedia() di halaman pemesanan
  function getMejaTersedia() {
    document.getElementById("id_meja").removeAttribute("disabled", "disabled");
    $.ajax({
      type: 'GET',
      url: `<?= base_url() ?>home/getMejaTersedia/`,
      dataType: 'json',
      success: (hasil) => {
        let isi = `<option disabled selected value="">Silakan Pilih Nomor Meja</option>`;

        // Jika tidak ada meja tersedia
        if (hasil.length === 0) {
          isi = `<option disabled selected value="">Tidak ada meja tersedia</option>`;
        } else {
          // Kelompokkan meja berdasarkan lokasi
          let mejaIndoor = hasil.filter(item => item.lokasi === 'indoor');
          let mejaOutdoor = hasil.filter(item => item.lokasi === 'outdoor');

          // Tambahkan grup untuk meja indoor
          if (mejaIndoor.length > 0) {
            isi += `<optgroup label="Area Indoor">`;
            mejaIndoor.forEach(function(item) {
              isi += `<option value="${item.id_meja}|${item.nomor_meja}">Meja ${item.nomor_meja} (Kapasitas: ${item.kapasitas_meja})</option>`;
            });
            isi += `</optgroup>`;
          }

          // Tambahkan grup untuk meja outdoor
          if (mejaOutdoor.length > 0) {
            isi += `<optgroup label="Area Outdoor">`;
            mejaOutdoor.forEach(function(item) {
              isi += `<option value="${item.id_meja}|${item.nomor_meja}">Meja ${item.nomor_meja} (Kapasitas: ${item.kapasitas_meja})</option>`;
            });
            isi += `</optgroup>`;
          }
        }

        $('#id_meja').html(isi);
      }
    });

    // Ambil data menu
    getMenu();

    // Reset status meja dan menu
    $('#keterangan_meja_dipilih').html("");
    updateMenuAccessibility();
  }

  function getMenu() {
    $.ajax({
      type: 'GET',
      url: `<?= base_url() ?>home/getMenu/`,
      dataType: 'json',
      success: (hasil) => {
        let isi = `<option disabled selected value="">Pilih Menu</option>`;
        hasil.forEach(function(item) {
          isi +=
            `<option value="${item.nama_menu}|${item.harga}">${item.nama_menu} - Rp ${formatRupiah(item.harga)}</option>`
        });
        $('#id_menu').html(isi);
      }
    });
  }

  // Fungsi tambah meja yang dipilih ke detail pesanan
  function tambah_meja(value) {
    if (!value) {
      $('#keterangan_meja_dipilih').html("");
      updateMenuAccessibility();
      return;
    }

    const splitMeja = value.split("|");
    if (splitMeja.length < 2) {
      alert("Format meja tidak valid!");
      return;
    }

    let id_meja = splitMeja[0];
    let nomor_meja = splitMeja[1];

    let isinyameja = `
  <b>Nomor Meja</b> = ${nomor_meja}
  <input type="hidden" name="hidden_id_meja" value="${id_meja}"> 
  <input type="hidden" name="hidden_nomor_meja" value="${nomor_meja}"> 
  `;
    $('#keterangan_meja_dipilih').html(isinyameja);

    // Update accessibility menu
    updateMenuAccessibility();
  }

  let num = 0;
  let menu_total = 0;
  let total_harga = 0;

  function setTotalHarga(total_harga_new) {
    total_harga = total_harga_new;
  }

  function getTotalHarga() {
    return total_harga;
  }

  function tambah_menu() {
    // Validasi terlebih dahulu apakah meja sudah dipilih
    if (!isMejaSelected()) {
      alert("Silakan pilih meja terlebih dahulu!");
      document.getElementById('id_meja').focus();
      return false;
    }

    // Validasi input lainnya
    let menu = $('#id_menu').val();
    let nama = $('#nama').val();
    let no_hp = $('#no_hp').val();
    let jumlah_pesanan = $('#jumlah_pesanan').val();

    // Validasi nama
    if (nama === "") {
      alert("Nama Tidak Boleh Kosong!");
      document.getElementById('nama').focus();
      return;
    }

    // Validasi nomor HP
    if (no_hp === "") {
      alert("Nomor HP Tidak Boleh Kosong!");
      document.getElementById('no_hp').focus();
      return;
    }

    // Validasi menu
    if (!menu) {
      alert("Menu harus dipilih!");
      document.getElementById('id_menu').focus();
      return;
    }

    // Validasi jumlah pesanan
    if (!jumlah_pesanan || parseInt(jumlah_pesanan) <= 0) {
      alert("Jumlah pesanan tidak boleh kosong atau kurang dari 1!");
      document.getElementById('jumlah_pesanan').focus();
      return;
    }

    // Update informasi nama dan nomor HP
    updateNamaNomorHP();

    menu_total += 1;
    num = num + 1;

    // Tampilkan setiap bagian sesuai kebutuhan
    document.getElementById("judul_menu").style.display = "";
    document.getElementById("tombol_booking").style.display = "";
    document.getElementById("daftar_harga_dipesan").style.display = "";
    document.getElementById("daftar_menu_dipesan").style.display = "";

    // Proses data menu dan hitung total
    const splitMenu = menu.split("|");
    if (splitMenu.length < 2) {
      alert("Format menu tidak valid!");
      return;
    }

    let hargaSatuan = parseInt(splitMenu[1]);
    let jumlahPesan = parseInt(jumlah_pesanan);
    let subtotal = jumlahPesan * hargaSatuan;

    total_harga += subtotal;
    setTotalHarga(total_harga);

    // Tampilkan total harga dengan pembayaran penuh dan format Rupiah
    let total_harga_teks = `
  <b>Total Harga : Rp ${formatRupiah(getTotalHarga())}<br>Biaya Yang Harus Dibayar : Rp ${formatRupiah(getTotalHarga())}</b>
  <input type="hidden" name="hidden_total_harga" value="${getTotalHarga()}">
  `;

    // Tambahkan menu ke daftar
    $('#daftar_menu_dipesan').append(`
  <span class="idpesanan${num}">
    ${splitMenu[0]} - (Jumlah : ${jumlah_pesanan})<br>
    <input type="hidden" name="hidden_nama_makanan[]" value="${splitMenu[0]}">
    <input type="hidden" name="hidden_jumlah_makanan[]" value="${jumlah_pesanan}">
    <input type="hidden" name="hidden_subtotal_makanan[]" value="${subtotal}">
  </span>
  `);

    // Tambahkan harga menu ke daftar dengan format Rupiah
    $('#daftar_harga_dipesan').append(`
  <span class="idpesanan${num}">
  Rp ${formatRupiah(splitMenu[1])}/satuan | Rp ${formatRupiah(subtotal)}<span onclick="hapusMenu(${num},${subtotal})" style="cursor: pointer"> <i class="fa fa-times"></i> Hapus</span><br>
  </span>
  `);

    // Update total harga
    $('#total_harga').html(total_harga_teks);

    // Reset form menu
    document.getElementById('id_menu').selectedIndex = 0;
    document.getElementById('jumlah_pesanan').value = "";
  }

  function hapusMenu(num, sub_total) {
    menu_total -= 1;
    $(`.idpesanan${num}`).remove();

    if (menu_total < 1) {
      // Reset semua jika tidak ada menu yang dipilih
      setTotalHarga(0);
      document.getElementById("tombol_booking").style.display = "none";
      document.getElementById("judul_menu").style.display = "none";
      $('#total_harga').html("");
      $('#daftar_menu_dipesan').html("");
      $('#daftar_harga_dipesan').html("");
    } else {
      // Update total harga
      let totalnya = getTotalHarga() - sub_total;
      setTotalHarga(totalnya);

      // Update tampilan total harga dengan format Rupiah
      let total_harga_teks = `
    <b>Total Harga : Rp ${formatRupiah(getTotalHarga())}<br>Biaya Yang Harus Dibayar : Rp ${formatRupiah(getTotalHarga())}</b>
    <input type="hidden" name="hidden_total_harga" value="${getTotalHarga()}">`;
      $('#total_harga').html(total_harga_teks);
    }
  }

  // Fungsi untuk memilih meja dari visualisasi
  function pilihMeja(element) {
    // Reset tampilan meja terpilih
    document.querySelectorAll('.meja-seat.tersedia').forEach(el => {
      el.classList.remove('meja-selected');
    });

    // Tambahkan kelas selected pada meja yang diklik
    element.classList.add('meja-selected');

    // Ambil data meja
    const idMeja = element.getAttribute('data-id');
    const nomorMeja = element.getAttribute('data-nomor');
    const kapasitasMeja = element.getAttribute('data-kapasitas');

    // Set nilai pada dropdown form
    const selectMeja = document.getElementById('id_meja');
    const options = selectMeja.options;

    // Cari opsi yang sesuai dengan meja yang dipilih
    for (let i = 0; i < options.length; i++) {
      const value = options[i].value;
      if (value && value.split('|')[0] === idMeja) {
        selectMeja.selectedIndex = i;
        // Simulasi onchange event untuk memicu fungsi tambah_meja()
        const event = new Event('change');
        selectMeja.dispatchEvent(event);
        break;
      }
    }

    // Scroll ke form pemesanan
    document.getElementById('contact-us').scrollIntoView({
      behavior: 'smooth'
    });
  }

  // Fungsi untuk menandai visualisasi meja ketika dipilih lewat dropdown
  function updateVisualMeja(idMeja) {
    // Reset tampilan meja terpilih
    document.querySelectorAll('.meja-seat.tersedia').forEach(el => {
      el.classList.remove('meja-selected');
    });

    // Cari dan tandai meja yang dipilih dari dropdown
    if (idMeja) {
      const selectedMeja = document.querySelector(`.meja-seat[data-id="${idMeja}"]`);
      if (selectedMeja) {
        selectedMeja.classList.add('meja-selected');
      }
    }
  }

  // Override fungsi tambah_meja untuk integrasi dengan visualisasi
  const originalTambahMeja = window.tambah_meja;
  window.tambah_meja = function(value) {
    // Jalankan fungsi asli
    originalTambahMeja(value);

    // Update visualisasi jika ada nilai
    if (value) {
      const splitMeja = value.split("|");
      if (splitMeja.length >= 1) {
        let id_meja = splitMeja[0];
        updateVisualMeja(id_meja);
      }
    } else {
      // Reset visual jika tidak ada nilai
      updateVisualMeja(null);
    }
  };

  // Tambahkan listener untuk dropdown meja
  document.addEventListener('DOMContentLoaded', function() {
    const selectMeja = document.getElementById('id_meja');
    if (selectMeja) {
      selectMeja.addEventListener('change', function() {
        const value = this.value;
        if (value) {
          const idMeja = value.split('|')[0];
          updateVisualMeja(idMeja);
        } else {
          updateVisualMeja(null);
        }
      });
    }
  });
</script>