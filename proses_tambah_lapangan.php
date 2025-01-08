<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lapangan = $_POST['nama_lapangan'];
    $harga = $_POST['harga'];
    $fasilitas = $_POST['fasilitas'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($gambar);
    
    // Pindahkan gambar ke folder uploads
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
        // Query untuk menambahkan data lapangan
        $query = "INSERT INTO lapangan (nama_lapangan, harga, gambar, fasilitas, deskripsi) VALUES ('$nama_lapangan', '$harga', '$gambar', '$fasilitas', '$deskripsi')";
        if (mysqli_query($koneksi, $query)) {
            header('Location: lapangan.php');
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
    }
}
?>
