<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Mahasigma Reservation</title>
    <link rel="icon" href="./image/favico.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.css"
        rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Memastikan body setidaknya setinggi viewport */
            overflow: auto;
            background-color: #E8ECD7;
        }
        body::-webkit-scrollbar {
            width: 0px;  /* Untuk scroll bar vertikal */
            height: 0px; /* Untuk scroll bar horizontal */
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
        .contact-section {
            text-align: center;
            padding: 50px 20px;
            margin-top: 5rem;
            flex-grow: 1; /* Memungkinkan section ini untuk tumbuh dan mengisi ruang */
        }

        .contact-section h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .contact-section p {
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .contact-section .contact-info {
            margin-bottom: 20px;
        }

        .contact-section .contact-info img {
            height: 40px;
            margin-right: 10px;
        }

        footer {
            background-color: #00a651;
            color: white;
            font-size: 14px;
            padding: 20px 0;
            margin-top: 10px;
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
        .contact-info a {
            text-decoration: none;
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <div class="flex items-center">
                <img alt="Logo" class="mr-2" height="70" src="./image/mahasigma-reservation-high-resolution-logo.png"
                    width="100%">
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
                        <a class="nav-link" href="pesanan.php">Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="kontak.php">Kontak</a>
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

    <div class="contact-section">
        <h2>Hubungi Kami</h2>
        <p>Jika Anda memiliki pertanyaan atau ingin melakukan reservasi, silakan hubungi kami melalui informasi di bawah ini:</p>

        <div class="contact-info">
            <img src="./image/wa.png" alt="WhatsApp Icon">
            <a href="https://wa.me/62895391544299" class="button">62+ 8953-9154-4299</a>
        </div>
        <p>atau</p>
        <div class="contact-info">
            <img src="./image/gmail.png" alt="Email Icon">
            <a href="mailto:denyriansyah05@gmail.com?subject=Judul Email&body=Halo, ini adalah isi email.">Kirim Email</a>
        </div>
    </div>
 <!--footer -->
<footer class="text-white text-center py-3">
    <div class="container">
        <h5 class="mb-3">MAHASIGMA RESERVATION</h5>
        <p class="mb-3">
            Menyediakan layanan reservasi atau pemesanan lapangan futsal dengan mudah dan cepat.
        </p>
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
    <!--Footer-->
    </footer>
    <div class="copyright text-center text-white py-2">
        <p class="mb-0">&copy; 2024 MAHASIGMA RESERVATION. All rights reserved.</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('profile-icon').addEventListener('click', function (event) {
            event.preventDefault(); // Mencegah aksi default tautan
            const popup = document.getElementById('profile-popup');
            if (popup.style.display === 'none' || popup.style.display === '') {
                popup.style.display = 'block'; // Tampilkan popup
            } else {
                popup.style.display = 'none'; // Sembunyikan popup
            }
        });

        // Menyembunyikan popup jika pengguna mengklik di luar elemen
        document.addEventListener('click', function (event) {
            const popup = document.getElementById('profile-popup');
            const icon = document.getElementById('profile-icon');
            if (!popup.contains(event.target) && !icon.contains(event.target)) {
                popup.style.display = 'none';
            }
        });
    </script>
</body>
</html>