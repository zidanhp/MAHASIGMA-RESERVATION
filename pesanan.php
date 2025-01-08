<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_lapangan = $_SESSION['id_lapangan'];
    $gambar = $_SESSION['gambar'];
    $nama_pemesan = $_SESSION['nama_pemesan'];
    $harga = $_SESSION['harga'];
    $nama_lapangan = $_SESSION['nama_lapangan'];
    $kategori = $_SESSION['kategori'];
    $tanggal_pemesanan = $_SESSION['tanggal_pemesanan'];
    $jam = $_SESSION['jam'];

    // Masukkan data ke database
    $stmt = $koneksi->prepare("INSERT INTO pemesan (username, nama_pemesan, tanggal_pemesanan, jam, nama_lapangan, kategori, harga, gambar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $_SESSION['username'], $nama_pemesan, $tanggal_pemesanan, $jam, $nama_lapangan, $kategori, $harga, $gambar);
    $stmt->execute();
    $stmt->close();
}

$query = "SELECT * FROM lapangan";
$result = $koneksi->query($query);

// Debug: pastikan data yang diambil
if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
}

$keyword = isset($_POST['search']) ? trim($_POST['search']) : '';
$query = "SELECT * FROM lapangan";

if (!empty($keyword)) {
    $query .= " WHERE nama_lapangan LIKE '%$keyword%'";
}

$result = $koneksi->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasigma Reservation</title>
    <link rel="icon" href="./image/favico.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.css"
        rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            box-sizing: border-box;
            background-color: #E8ECD7;
        }

        body::-webkit-scrollbar {
            width: 0px;
            /* Untuk scroll bar vertikal */
            height: 0px;
            /* Untuk scroll bar horizontal */
        }

        div h2 {
            margin-top: 5%;
            margin-bottom: 2%;
        }

        .navbar {
            background-color: #00a651;
            height: 10%;
        }

        .navbar-brand img {
            height: 40px;
        }

        .navbar li {
            margin-right: 20px;
            padding: 0;
        }

        .navbar li a:hover {
            background-color: #00773a;
        }

        .navbar-nav .nav-link {
            color: white !important;
            font-size: 16px;
            padding: 12px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            background-color: #00773a;
             transform: scale(1.05); /* Slight zoom effect */
        }
        .nav-link.active {
            background-color: #00773a; /* Warna hijau saat aktif */
            color: white !important;
            border-radius: 5px; /* Membulatkan sudut */
            transition: background-color 0.3s ease;
            transform: scale(1.05); 
        }

        form .form-control {
            margin-right: 20px;
            margin-bottom: 7px;
        }

        form .btn {
            display: none;
        }

        #profile-icon {
            color: black;
            font-size: 30px;
            cursor: pointer;
            margin-right: 14px;
            margin-left: 15px;
            margin-top: 10px;
        }

        .profile-popup h3 {
            margin: 0;
            font-size: 18px;
        }

        .profile-popup a {
            color: blue;
            text-decoration: none;
        }

        .profile-popup {
            display: none; /* Sembunyikan secara default */
            position: absolute;
            top: 60px; /* Sesuaikan posisi */
            right: 10px;
            background-color: white;
            padding: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            z-index: 1000;
            width: 200px;
        }

        .row {
            margin-bottom: 10%;
        }

        div h2 {
            margin-top: 8%;
        }

        .order-card {
            display: flex;
            align-items: center;
            background-color: #f1f1f1;
            /* Warna abu-abu */
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .order-card img {
            width: 250px;
            height: 200px;
            border-radius: 5px;
        }

        .order-details {
            flex-grow: 1;
            padding-left: 30px;
            margin-top: 20px;
        }

        .order-price {
            flex: 1;
            text-align: right;
            font-size: 14px;
            color: #333;
            margin: 25px;
            margin-top: 35px;
        }

        .order-status {
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .content {
        flex: 1; /* Membuat konten utama fleksibel */
        }
        /* CSS untuk tombol Cetak Resi yang lebih kecil dengan satuan rem */
        .btn-primary {
            margin-top: 0.625rem; /* 10px dalam rem (10 / 16 = 0.625) */
            width: auto; /* Lebar tombol menyesuaikan konten */
            text-align: center; /* Teks tombol berada di tengah */
            padding: 0.3125rem 0.625rem; /* 5px 10px dalam rem (5 / 16 = 0.3125, 10 / 16 = 0.625) */
            border-radius: 0.3125rem; /* 5px dalam rem (5 / 16 = 0.3125) */
            background-color: #007bff; /* Warna biru untuk tombol */
            border: none; /* Menghilangkan border default */
            font-size: 0.75rem; /* 12px dalam rem (12 / 16 = 0.75) */
            transition: background-color 0.3s ease; /* Efek transisi saat hover */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Warna biru lebih gelap saat hover */
            transform: scale(1.05); /* Sedikit memperbesar tombol saat hover */
        }

        footer {
            background-color: #00a651;
            color: white;
            font-size: 14px;
            padding: 20px 0;
            margin-top: auto; /* Pastikan footer selalu berada di bawah */
        }

        footer .bi {
            font-size: 20px;
            margin-right: 7px;
            vertical-align: middle;
        }

        footer a {
            color: white; /* Warna default teks */
            text-decoration: none; /* Menghapus garis bawah */
            transition: color 0.3s ease, transform 0.3s ease; /* Transisi warna dan transformasi */
        }

        footer a:hover {
            color: #ffcc00; /* Warna teks saat hover */
            text-decoration: underline; /* Menambahkan garis bawah pada hover */
            transform: scale(1.1); /* Sedikit memperbesar teks saat hover */
        }

        footer .bi:hover {
            color: #ffcc00; /* Warna ikon saat hover */
            transform: rotate(20deg); /* Ikon sedikit berputar saat hover */
        }

        .copyright {
        background-color: rgb(1, 133, 64);
        font-size: 14px;
        }
    </style>
</head>

<body class="bg-gray-100">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <div class="flex items-center">
                <img alt="Logo" class="mr-2" height="70" src="./image/mahasigma-reservation-high-resolution-logo.png"
                    width="100%" />
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto me-4">
                    <li class="nav-item">
                        <a class="nav-link" href="beranda.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="menu_lapangan.php">Lapangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="pesanan.php">Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontak.php">Kontak</a>
                    </li>
                </ul>
            </div>
                        <form action="menu_lapangan.php" method="post">
                <input class="form-control me-2 mt-2" type="text" name="search" placeholder="Cari..."
                    value="<?php echo htmlspecialchars($keyword); ?>" size="5">
                <button class="btn btn-outline-success" type="submit">Cari</button>
            </form>
            <div class="icon">
                <a href="#" class="fas fa-user-circle fa-2x" id="profile-icon"></a>
            </div>
            <div id="profile-popup" class="profile-popup">
                <h3><?php echo htmlspecialchars($_SESSION['username']); ?></h3>
                <p>..........</p>
                <a href="ganti_sandi.php">Ubah Kata Sandi</a>
                <br>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="content container">
        <h2 class="text-center">Riwayat Pemesanan</h2>

        <?php
        // Query untuk mendapatkan data berdasarkan username
        $query = "SELECT * FROM pemesan WHERE username = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute();
        $result = $stmt->get_result();

        // Tampilkan data
        while ($row = $result->fetch_assoc()) : ?>
        <div class="order-card d-flex align-items-center">
    <!-- Gambar Lapangan -->
    <img src="uploads/<?= htmlspecialchars($row['gambar']); ?>" class="img-fluid" alt="Gambar Lapangan">

    <!-- Detail Pesanan -->
    <div class="order-details">
        <form method="POST" action="pesanan.php">
            <p><strong>Nama Lapangan:</strong> <?= htmlspecialchars($row['nama_lapangan']); ?></p>
            <p><strong>Kategori:</strong> <?= htmlspecialchars($row['kategori']); ?></p>
            <p><strong>Tanggal Pemesanan:</strong> <?= htmlspecialchars($row['tanggal_pemesanan']); ?></p>
            <p><strong>Jam Pesanan:</strong> <?= htmlspecialchars($row['jam']); ?></p>
        </form>
    </div>

    <!-- Harga Pesanan -->
    <div class="order-price">
        <p><strong>Harga:</strong> Rp. <?= number_format($row['harga'], 0, ',', '.'); ?></p>
    </div>

    <!-- Status Pesanan dan Tombol Cetak Resi -->
    <div class="status-and-resi">
        <!-- Status Pesanan -->
        <div class="order-status btn 
            <?php 
                if ($row['status_bayar'] == 'Sudah Bayar') {
                    echo 'btn-success'; // Warna hijau jika sudah bayar
                } elseif ($row['status_bayar'] == 'Batal Pesan') {
                    echo 'btn-warning'; // Warna kuning jika batal pesan
                } else {
                    echo 'btn-danger'; // Warna merah jika belum bayar
                }
            ?> btn-sm">
            <?= htmlspecialchars($row['status_bayar']); ?>
        </div>

        <!-- Tombol Cetak Resi -->
        <div class="mt-1">
            <a href="cetak_resi.php?id=<?= htmlspecialchars($row['id']); ?>" class="btn btn-primary">Cetak Resi</a>
        </div>
    </div>
</div>
        <?php endwhile; ?>
        
    </div>

   <!--footer -->
   <footer class="text-white text-center py-3">
        <div class="container">
            <h5 class="mb-3">MAHASIGMA RESERVATION</h5>
            <p class="mb-3">Menyediakan layanan reservasi atau pemesanan lapangan futsal dengan mudah dan cepat.</p>
            <div>
                <a href="https://www.instagram.com" class="text-white mx-2">
                    <i class="bi bi-instagram"></i> @Mahasigma_Reservation
                </a>
                <a href="https://www.tiktok.com" class="text-white mx-2">
                    <i class="bi bi-tiktok"></i> MAHASIGMA
                </a>
                <a href="https://www.facebook.com" class="text-white mx-2">
                    <i class="bi bi-facebook"></i> MAHASIGMA RESERVATION
                </a>
            </div></br>
            <a href="https://maps.app.goo.gl/EnTkQjMoTAhNVsYT9">Jl. Ahmad Yani Batam Kota Kota Batam, Kepulauan Riau Indonesia</a>
        </div>
    </footer>
    <div class="copyright text-center text-white py-2">
        <p class="mb-0">&copy; 2024 MAHASIGMA RESERVATION. All rights reserved.</p>
    </div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.getElementById('profile-icon').addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah aksi default tautan
        const popup = document.getElementById('profile-popup');
        if (popup.style.display === 'none' || popup.style.display === '') {
            popup.style.display = 'block'; // Tampilkan popup
        } else {
            popup.style.display = 'none'; // Sembunyikan popup
        }
    });

    // Menyembunyikan popup jika pengguna mengklik di luar elemen
    document.addEventListener('click', function(event) {
        const popup = document.getElementById('profile-popup');
        const icon = document.getElementById('profile-icon');
        if (!popup.contains(event.target) && !icon.contains(event.target)) {
            popup.style.display = 'none';
        }
    });
    </script>
</body>

</html>