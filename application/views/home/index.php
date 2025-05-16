<?php
// Load header
$this->load->view('home/layout/header');
?>

<!-- ======= Hero Section ======= -->
<section id="hero">
  <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
    <div class="carousel-inner" role="listbox">
      <div class="carousel-inner" role="listbox">
        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(<?= base_url() ?>assets/dataresto/foto_usaha/<?= $foto_usaha_1 ?>)">
          <div class="hero-content">
            <h1>Selamat Datang di <?= $nama_usaha ?></h1>
            <p>Nikmati sensasi kopi pilihan terbaik dengan cita rasa autentik yang memanjakan lidah</p>
            <a href="<?= base_url() ?>katalog" class="btn btn-hero">Jelajahi Menu</a>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url(<?= base_url() ?>assets/dataresto/foto_usaha/<?= $foto_usaha_2 ?>)">
          <div class="hero-content">
            <h1>Kopi Spesial Kami</h1>
            <p>Dibuat dari biji kopi premium dan disajikan oleh barista berpengalaman</p>
            <a href="<?= base_url() ?>home/pemesanan" class="btn btn-hero">Pesan Sekarang</a>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url(<?= base_url() ?>assets/dataresto/foto_usaha/<?= $foto_usaha_3 ?>)">
          <div class="hero-content">
            <h1>Suasana Nyaman</h1>
            <p>Tempat yang sempurna untuk menikmati secangkir kopi sambil bekerja atau bersantai</p>
            <a href="<?= base_url() ?>home/cekbayar" class="btn btn-hero">Cek Pembayaran</a>
          </div>
        </div>

        <!-- Slide 4 -->
        <div class="carousel-item" style="background-image: url(<?= base_url() ?>assets/dataresto/foto_usaha/<?= $foto_usaha_4 ?>)">
          <div class="hero-content">
            <h1>Kopi Berkualitas Premium</h1>
            <p>Rasakan kelezatan kopi asli Indonesia yang diseduh dengan metode khusus</p>
            <a href="<?= base_url() ?>home/krisar" class="btn btn-hero">Kritik & Saran</a>
          </div>
        </div>

        <!-- Slide 5 -->
        <div class="carousel-item" style="background-image: url(<?= base_url() ?>assets/dataresto/foto_usaha/<?= $foto_usaha_5 ?>)">
          <div class="hero-content">
            <h1>Pelayanan Terbaik</h1>
            <p>Barista kami siap memberikan pengalaman kopi terbaik untuk Anda</p>
            <a href="#about" class="btn btn-hero">Tentang Kami</a>
          </div>
        </div>
      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>
    </div>
</section><!-- End Hero -->

<main id="main">
  <!-- Rest of the content remains the same -->
  <section id="about" class="about">
    <div class="container">

      <div class="section-title">
        <h2>TENTANG <?= $nama_usaha ?></h2>
      </div>

      <div class="row content">
        <div class="col-lg-6 pt-4 pt-lg-0">
          <p>
            <?= $deskripsi ?>
          </p><br>
        </div>
        <div class="col-lg-6">
          <img style="width: 100%;" src="<?php echo base_url('assets/dataresto/foto_usaha/' . $foto_usaha_1) ?>" />
        </div>
      </div>

    </div>
  </section>

  <section id="about" class="about">
    <div class="container">
      <div class="section-title">
        <h2>Informasi <?= $nama_usaha ?></h2>
        <p>Selamat Datang di kedai kami</p>
      </div>

      <div class="row content">
        <div class="col-lg-6">
          <?php
          if ($maps_link !== "") {
          ?>
            <iframe src="<?= $maps_link ?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          <?php
          } else {
          ?>
            <h3><?= $nama_usaha ?> belum menambahkan google maps</h3>
          <?php
          }
          ?>
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0">
          <p>
            Informasi Mengenai <?= $nama_usaha ?>
          </p>
          <ul>
            <li><i class="ri-check-double-line"></i>Alamat : <?= $alamat ?></li>
            <li><i class="ri-check-double-line"></i>No Telepon : <?= $nomor_telepon ?></li>
            <li><i class="ri-check-double-line"></i>Jam Opersional : <?= $jam_operasional ?></li>
            <li><i class="ri-check-double-line"></i>Instagram : <a href="https://instagram.com/<?= $instagram ?>">@<?= $instagram ?></a></li>
            <li><i class="ri-check-double-line"></i>Facebook : <a href="https://facebook.com/<?= $facebook ?>"><?= $facebook ?></a></li>
          </ul>
        </div>
      </div>
    </div>
  </section><!-- End My & Family Section -->

  <!-- ======= Features Section ======= -->
  <section id="features" class="features">
    <div class="container">
      <div class="section-title">
        <h2>PELAYANAN ONLINE</h2>

      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6 icon-box">
          <div class="icon"><i class="bi bi-laptop"></i></div>
          <h4 class="title"><a href="">Pemesanan</a></h4>
          <p class="description">Layanan pemesanan menu secara online bisa anda lakukan dari tempat duduk anda dikedai.</p>
        </div>
        <div class="col-lg-4 col-md-6 icon-box">
          <div class="icon"><i class="bi bi-bar-chart"></i></div>
          <h4 class="title"><a href="">Pembayaran</a></h4>
          <p class="description">Pembayaran dapat dibayar melalui <br> E-Money atau Tunai.</br></p>
        </div>
        <div class="col-lg-4 col-md-6 icon-box">
          <div class="icon"><i class="bi bi-hand-thumbs-up"></i></div>
          <h4 class="title"><a href="">Easy to Use</a></h4>
          <p class="description">Anda dapat memesan dan melihat tentang profil kami secara mudah dan cepat.</p>
        </div>

      </div>

    </div>
  </section><!-- End Features Section -->

  <!-- ======= Recent Photos Section / Menu Spesial ======= -->
  <section id="recent-photos" class="recent-photos">
    <div class="container">
      <div class="section-title">
        <h2>MENU SPESIAL</h2>
        <p>Menyajikan kopi dan hidangan berkualitas, kini siapa saja bisa menikmati pengalaman kuliner istimewa hanya dengan berkunjung ke <?= $nama_usaha ?>. Semua yang anda cari ada disini!</p>
      </div>

      <!-- Smooth Scrolling Menu Using CSS Animation -->
      <div class="menu-scroll-container">
        <div class="menu-scroll-track">
          <?php foreach ($gambar_menu as $m) { ?>
            <div class="menu-item">
              <a href="<?php echo base_url('assets/dataresto/menu/' . $m['gambar']) ?>" class="glightbox">
                <img src="<?php echo base_url('assets/dataresto/menu/' . $m['gambar']) ?>"
                  class="menu-image"
                  alt="Menu <?= $nama_usaha ?>">
              </a>
            </div>
          <?php } ?>
          <!-- Duplikasi menu untuk efek scroll yang mulus -->
          <?php foreach ($gambar_menu as $m) { ?>
            <div class="menu-item">
              <a href="<?php echo base_url('assets/dataresto/menu/' . $m['gambar']) ?>" class="glightbox">
                <img src="<?php echo base_url('assets/dataresto/menu/' . $m['gambar']) ?>"
                  class="menu-image"
                  alt="Menu <?= $nama_usaha ?>">
              </a>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </section><!-- End Recent Photos Section -->

  <!-- ======= Development Team Section ======= -->
  <section id="dev-team" class="dev-team">
    <div class="container">
      <div class="section-title">
        <h2>TIM PENGEMBANG</h2>
        <p>Aplikasi ini dikembangkan oleh tim mahasiswa berbakat dari Universitas Negeri Surabaya</p>
      </div>

      <div class="row">
        <!-- Developer 1 -->
        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="member">
            <div class="member-img">
              <img src="<?= base_url() ?>assets/home/img/yayang.jpeg" class="img-fluid" alt="Developer">
              <div class="social">
                <a href="https://github.com/zeroynr/kedaikopi.git"><i class="bi bi-github"></i></a>
              </div>
            </div>
            <div class="member-info">
              <h4>YAYANG BARRU AFRIZA</h4>
              <span>23050974041</span>
              <p>Data Analyst</p>
            </div>
          </div>
        </div>

        <!-- Developer 2 -->
        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="member">
            <div class="member-img">
              <img src="<?= base_url() ?>assets/home/img/nazril.jpeg" class="img-fluid" alt="Developer">
              <div class="social">
                <a href="https://github.com/zeroynr/kedaikopi.git"><i class="bi bi-github"></i></a>
              </div>
            </div>
            <div class="member-info">
              <h4>MOCHAMAD NAZRIL ILHAM</h4>
              <span>23050974049</span>
              <p>UI/UX Designer</p>
            </div>
          </div>
        </div>

        <!-- Developer 3 -->
        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="member">
            <div class="member-img">
              <img src="<?= base_url() ?>assets/home/img/ridho.jpeg" class="img-fluid" alt="Developer">
              <div class="social">
                <a href="https://github.com/zeroynr/kedaikopi.git"><i class="bi bi-github"></i></a>
              </div>
            </div>
            <div class="member-info">
              <h4>MUHAMMAD RIDHO ARDIANSYAH</h4>
              <span>23050974059</span>
              <p>Front-end and Back-end Developer</p>
            </div>
          </div>
        </div>

        <!-- Developer 4 -->
        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="member">
            <div class="member-img">
              <img src="<?= base_url() ?>assets/home/img/himmati.jpeg" class="img-fluid" alt="Developer">
              <div class="social">
                <a href="https://github.com/zeroynr/kedaikopi.git"><i class="bi bi-github"></i></a>
              </div>
            </div>
            <div class="member-info">
              <h4>HIMMATI MUYASSAROH</h4>
              <span>23050974064</span>
              <p>Documentation</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Development Team Section -->

  <!-- CSS untuk ditambahkan ke file CSS Anda -->
  <style>
    .menu-scroll-container {
      width: 100%;
      overflow: hidden;
      position: relative;
      padding: 10px 0;
      margin-bottom: 10px;
      /* Lebih dekat ke footer */
    }

    .menu-scroll-track {
      display: flex;
      width: fit-content;
      animation: smoothScroll 40s linear infinite;
      /* 40 detik untuk scroll penuh, sangat lambat */
    }

    .menu-item {
      width: 280px;
      flex-shrink: 0;
      margin: 0 15px;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
      background: #fff;
    }

    .menu-item:hover {
      transform: translateY(-5px);
    }

    .menu-image {
      width: 100%;
      height: 220px;
      object-fit: cover;
      display: block;
    }

    /* Animation untuk scroll mulus tanpa jeda */
    @keyframes smoothScroll {
      0% {
        transform: translateX(0);
      }

      100% {
        transform: translateX(-50%);
        /* Hanya menggeser setengah total width (karena konten diduplikasi) */
      }
    }

    /* Mengurangi padding bawah dari section */
    .recent-photos {
      padding-bottom: 30px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .menu-image {
        height: 180px;
      }

      .menu-item {
        width: 240px;
        margin: 0 10px;
      }
    }

    /* Styles for Development Team section to match light theme like other sections */
    .dev-team {
      padding: 80px 0;
      background: #fff;
      /* Light background to match other sections */
      position: relative;
    }

    .dev-team:before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
    }

    .dev-team .section-title h2 {
      color: #2c4964;
      /* Consistent with other sections */
      font-size: 32px;
      font-weight: 700;
      text-transform: uppercase;
      margin-bottom: 20px;
      position: relative;
      display: inline-block;
    }

    .dev-team .section-title h2:after {
      content: '';
      position: absolute;
      display: block;
      width: 60px;
      height: 3px;
      background: #ff7e00;
      /* Orange accent to match POS CAFE */
      bottom: 0px;
      left: 50%;
      transform: translateX(-50%);
    }

    .dev-team .section-title p {
      margin-bottom: 40px;
      color: #666;
      /* Standard text color */
    }

    .dev-team .member {
      margin-bottom: 30px;
      box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      background: #fff;
      overflow: hidden;
      transition: all 0.3s ease-in-out;
    }

    .dev-team .member:hover {
      transform: translateY(-10px);
      box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.15);
    }

    .dev-team .member .member-img {
      position: relative;
      overflow: hidden;
    }

    .dev-team .member .member-img img {
      width: 100%;
      height: 260px;
      object-fit: cover;
      transition: all 0.3s ease;
    }

    .dev-team .member:hover .member-img img {
      transform: scale(1.1);
    }

    .dev-team .member .social {
      position: absolute;
      left: 0;
      bottom: -40px;
      right: 0;
      height: 40px;
      opacity: 0;
      transition: bottom 0.5s ease, opacity 0.5s ease;
      background: rgba(255, 126, 0, 0.85);
      /* Orange to match POS CAFE */
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .dev-team .member:hover .social {
      bottom: 0;
      opacity: 1;
    }

    .dev-team .member .social a {
      transition: color 0.3s;
      color: #fff;
      margin: 0 10px;
      font-size: 18px;
    }

    .dev-team .member .social a:hover {
      color: #ffcda3;
    }

    .dev-team .member .member-info {
      padding: 25px 15px;
      text-align: center;
    }

    .dev-team .member .member-info h4 {
      font-weight: 700;
      margin-bottom: 5px;
      font-size: 18px;
      color: #2c4964;
      /* Standard heading color */
    }

    .dev-team .member .member-info span {
      display: block;
      font-size: 14px;
      font-weight: 500;
      color: #ff7e00;
      /* Orange color to match theme */
      margin-bottom: 10px;
    }

    .dev-team .member .member-info p {
      font-style: italic;
      font-size: 14px;
      line-height: 26px;
      color: #777777;
      /* Standard paragraph color */
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
      .dev-team .member {
        margin-bottom: 30px;
      }
    }

    @media (max-width: 768px) {
      .dev-team .member .member-img img {
        height: 220px;
      }
    }
  </style>
</main><!-- End #main -->

<?php
// Load footer
// $this->load->view('home/layout/footer');
?>