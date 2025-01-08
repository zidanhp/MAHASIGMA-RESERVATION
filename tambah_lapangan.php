<?php
// File: tambah_lapangan.php
include 'koneksi.php'; // Sambungkan ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama_lapangan = mysqli_real_escape_string($koneksi, $_POST['nama_lapangan']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $fasilitas = mysqli_real_escape_string($koneksi, $_POST['fasilitas']);
    
    // Cek apakah nama lapangan sudah ada di database
    $queryCheck = mysqli_query($koneksi, "SELECT * FROM lapangan WHERE nama_lapangan = '$nama_lapangan'");
    if (mysqli_num_rows($queryCheck) > 0) {
        // Jika nama lapangan sudah ada, tampilkan pesan kesalahan
        echo "<script>alert('Nama lapangan sudah ada. Mohon gunakan nama yang berbeda.'); window.location.href='lapangan.php';</script>";
    } else {
        // Jika nama lapangan belum ada, lanjutkan untuk menyimpan data
        $gambar = $_FILES['gambar'];
        if ($gambar['name'] != '') {
            // Jika ada gambar baru, proses upload gambar
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($gambar['name']);
            $uploadOk = 1;

            // Validasi tipe file gambar
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

            if (!in_array($imageFileType, $allowedTypes)) {
                echo "<script>alert('File gambar harus dalam format JPG, JPEG, PNG, atau GIF'); window.location.href='lapangan.php';</script>";
                $uploadOk = 0;
            }

            if ($uploadOk && move_uploaded_file($gambar['tmp_name'], $target_file)) {
                $gambarBaru = basename($gambar['name']);
            } else {
                echo "<script>alert('Gagal mengunggah file gambar'); window.location.href='lapangan.php';</script>";
                $gambarBaru = '';
            }
        } else {
            // Jika tidak ada gambar baru, set gambar kosong atau gambar default
            $gambarBaru = '';
        }

        // Query untuk menambah data lapangan baru
        $queryInsert = "INSERT INTO lapangan (nama_lapangan, kategori, harga, gambar, deskripsi, fasilitas) 
                        VALUES ('$nama_lapangan', '$kategori', '$harga', '$gambarBaru', '$deskripsi', '$fasilitas')";
        
        if (mysqli_query($koneksi, $queryInsert)) {
            echo "<script>alert('Data lapangan berhasil ditambahkan'); window.location.href='lapangan.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menambahkan data'); window.location.href='lapangan.php';</script>";
        }
    }
} else {
    header('Location: lapangan.php');
}
?>
