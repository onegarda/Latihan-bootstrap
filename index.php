<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mercie</title>

    <!-- Bootstrap & CSS -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="asset/css/latbootstrap.css" />

    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>

  <body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
      <div class="container">
        <a class="navbar-brand fw-bold" href="#home">Mercie</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="#kategori">Kategori</a></li>
            <li class="nav-item"><a class="nav-link" href="#produk">Coming Soon</a></li>
            <li class="nav-item"><a class="nav-link" href="#promo">Promo</a></li>
            <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- HERO -->
    <section id="home" class="hero">
      <video autoplay muted loop class="bg-video">
        <source src="asset/img/1730806330098-0001-0250.mp4" type="video/mp4" />
      </video>
      <div class="overlay"></div>
      <div class="hero-content text-center text-white animate-fadeup">
        <h1 class="display-4 fw-bold mt-5">Mercie Product</h1>
        <p class="lead">Fashion, Lifestyle, Culture</p>
      </div>
    </section>

    <!-- KATEGORI (Dari Database) -->
<<!-- KATEGORI (Dari Database) -->
<section id="kategori" class="py-5 bg-light text-dark">
  <div class="container text-center">
    <h2 class="fw-bold mb-4">Kategori Produk</h2>
    <div class="row">
      <?php
      include "config.php";
      $sql = "SELECT * FROM kateproduk";
      $result = $conn->query($sql);

      if ($result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
      ?>
          <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm kategori-overlay" data-bs-toggle="modal" data-bs-target="#popup<?= $row['id'] ?>">
              <img src="<?= htmlspecialchars($row['gambar']) ?>" class="card-img-top" >
              <div class="overlay-text"><?= htmlspecialchars($row['nama']) ?></div>
            </div>
          </div>
      <?php
        endwhile;
      else:
        echo "<p>Belum ada data kategori produk.</p>";
      endif;
      $conn->close();
      ?>
    </div>
  </div>
</section>

    <!-- COMING SOON -->
    <section id="produk" class="comingsoon-section d-flex align-items-center justify-content-center text-center text-white">
      <div class="container">
        <h2 class="comingsoon-title">COMING SOON</h2>
        <div class="comingsoon-box mt-5 mx-auto">
          <div class="glow-ring"></div>
          <img src="asset/img/New pieces, real textures, real details. See you there.Catch us @u.s.s , JCC Senayan, Nov 7–9 20.jpg" alt="Coming Soon" class="comingsoon-img">
        </div>
      </div>
    </section>

    <!-- PROMO -->
    <section id="promo" class="promo-section d-flex text-center text-white">
      <video autoplay muted loop class="promo-video">
        <source src="asset/img/7 -9 NOVEMBER 2025 @u.s.s EXCLUSIVE RELEASE.mov" type="video/mp4">
      </video>
      <div class="promo-overlay"></div>
      <div class="promo-content w-100">
        <h2 class="fw-bold mb-3 promo-title">Promo Spesial</h2>
        <p class="promo-text">Dapatkan diskon hingga 50% untuk produk pilihan bulan ini!</p>
      </div>
    </section>

        <!-- ABOUT (CHARTJS) -->
    <section id="about" class="py-5 bg-dark text-light text-center">
      <div class="container">
        <h2 class="fw-bold mb-4">About Us & Data Grafik</h2>
        <p class="mb-4">Kami selalu berinovasi dalam setiap produk. Berikut contoh data penjualan kami:</p>
        <canvas id="salesChart" width="400" height="200"></canvas>
      </div>
    </section>

    <!-- KONTAK -->
<section id="kontak" class="py-5 text-dark bg-light">
  <div class="container text-center">
    <h2 class="fw-bold mb-4">Hubungi Kami</h2>
    <form id="contactForm" class="w-75 mx-auto">
      <div class="mb-3">
        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
      </div>
      <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
      </div>
      <div class="mb-3">
        <textarea name="pesan" class="form-control" rows="4" placeholder="Tulis pesan kamu di sini..." required></textarea>
      </div>
      <button type="submit" class="btn btn-dark px-4">Kirim Pesan</button>
      <div id="statusMsg" class="mt-3"></div>
    </form>
  </div>
</section>

    <!-- FOOTER -->
    <footer class="text-center text-light py-3 bg-dark">
      <p>© 2025 Mercie. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- === SCRIPT: Menu Active + Smooth Scroll + ChartJS === -->
    <script>
      // --- MENU ACTIVE & AUTO SCROLL ---
      const navLinks = document.querySelectorAll('.nav-link');
      navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          navLinks.forEach(l => l.classList.remove('active'));
          this.classList.add('active');
          const target = document.querySelector(this.getAttribute('href'));
          target.scrollIntoView({ behavior: 'smooth' });
        });
      });

      // --- CHART.JS DATA STATIS ---
      let salesChart; // deklarasi global chart

// === FUNGSI UNTUK MENGAMBIL DATA DARI DATABASE (PHP) ===
async function fetchSalesData() {
  const response = await fetch('data/get_sales.php');
  const data = await response.json();

  const labels = data.map(item => item.produk);
  const values = data.map(item => item.jumlah);

  return { labels, values };
}

// === FUNGSI UNTUK MEMBUAT CHART PERTAMA KALI ===
async function createChart() {
  const { labels, values } = await fetchSalesData();
  const ctx = document.getElementById('salesChart').getContext('2d');

  salesChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: 'Penjualan (unit)',
        data: values,
        backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0']
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { labels: { color: 'white' } },
        title: {
          display: true,
          text: 'Data Penjualan Produk (Realtime)',
          color: 'white',
          font: { size: 18 }
        }
      },
      scales: {
        x: { ticks: { color: 'white' } },
        y: { ticks: { color: 'white' } }
      }
    }
  });
}

// === FUNGSI UNTUK UPDATE DATA SECARA REALTIME ===
async function updateChart() {
  const { labels, values } = await fetchSalesData();

  salesChart.data.labels = labels;
  salesChart.data.datasets[0].data = values;
  salesChart.update();
}

// === JALANKAN SAAT HALAMAN DIMUAT ===
createChart();

// === PERBARUI DATA SETIAP 5 DETIK ===
setInterval(updateChart, 5000);

// --- SCRIPT FORM KONTAK ---
  const form = document.getElementById("contactForm");
  const statusMsg = document.getElementById("statusMsg");

  form.addEventListener("submit", async function (e) {
    e.preventDefault();
    const formData = new FormData(form);

    const response = await fetch("data/save_contact.php", {
      method: "POST",
      body: formData,
    });

    const result = await response.text();

    if (result.trim() === "success") {
      statusMsg.innerHTML = '<div class="alert alert-success">Pesan berhasil dikirim!</div>';
      form.reset();
    } else if (result.trim() === "empty") {
      statusMsg.innerHTML = '<div class="alert alert-warning">Harap isi semua kolom!</div>';
    } else {
      statusMsg.innerHTML = '<div class="alert alert-danger">Terjadi kesalahan. Coba lagi!</div>';
    }

    // Hilangkan pesan setelah 3 detik
    setTimeout(() => (statusMsg.innerHTML = ""), 3000);
  });
    </script>
  </body>
</html>
