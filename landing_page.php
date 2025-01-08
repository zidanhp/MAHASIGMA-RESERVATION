<html>
<head>
<title>Mahasigma Reservation</title>
    <link rel="icon" href="./image/favico.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.css"
        rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
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
        .btn-custom {
            padding: 8px 15px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
        }

        .btn-register {
            background-color: #00773a;
        }

        .btn-login {
            background-color: #dc3545;
        }

        .btn-custom {
            margin-right: 10px;
        }

        .carousel-inner {
            width: 100%; /* Lebar carousel mengikuti lebar layar */
            max-width: 100%; /* Pastikan tidak melampaui lebar layar */
            overflow: hidden; /* Sembunyikan bagian gambar yang melampaui kontainer */
        }

        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .lapangan-title {
            text-align: center;
            margin: 20px 0;
        }

        .card {
            margin: 10px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2), 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card img {
            height: 30vh;
        }

        .footer {
            background-color: #00a651;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: auto;
        }

        .content {
            flex: 1; /* Membuat konten utama fleksibel */
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

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <div class="flex items-center">
                <img alt="Logo" class="mr-2" height="70" src="./image/mahasigma-reservation-high-resolution-logo.png" width="100%">
            </div>
            <div>
                <a href="daftar.php" class="btn-custom btn-register">Daftar</a>
                <a href="login.php" class="btn-custom btn-login">Login</a>
            </div>
        </div>
    </nav>

    <!-- Carousel -->
    <div class="bg-gray-100">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://asset.ayo.co.id/image/venue/172517438086080.image_cropper_1725174289741_large.jpg" class="d-block w-100 img-fluid" class="d-block w-100 img-fluid" alt="Slide 1" data-bs-toggle="modal" data-bs-target="#produk1">
                </div>
                <div class="carousel-item">
                    <img src="./image/lapangan2.jpg" class="d-block w-100 img-fluid" alt="Slide 2" data-bs-toggle="modal" data-bs-target="#produk5">
                </div>
                <div class="carousel-item">
                    <img src="./image/pxfuel.jpg" class="d-block w-100 img-fluid" alt="Slide 3" data-bs-toggle="modal" data-bs-target="#produk10">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>

    <!-- Content -->
    <div id="home" class="container-fluid mt-5">
        <div class="row g-0">
            <div class="container">
                <h2 class="lapangan-title">Lapangan</h2>
                <div class="row mt-4">
                    <!-- Ambil data lapangan dari database -->
                    <?php 
                    include 'koneksi.php';
                    $query = mysqli_query($koneksi, "SELECT * FROM lapangan");
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <!-- Gambar Lapangan -->
                            <img src="uploads/<?php echo $data['gambar']; ?>" alt="Gambar Lapangan" class="card-img-top img-fluid">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $data['nama_lapangan']; ?></h5>
                                <p class="card-text">Harga: Rp. <?php echo number_format($data['harga'], 0, ',', '.'); ?>
                                    /Jam</p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

<!-- footer -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
