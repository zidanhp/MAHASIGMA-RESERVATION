<?php 
// Memasukkan koneksi database
include 'koneksi.php'; // INCLUDE koneksi.php

// Ambil ID lapangan dari parameter URL
$id_lapangan = $_GET['id_lapangan']; // id_lapangan ← Ambil nilai dari URL parameter 'id_lapangan'

// Ambil data lapangan berdasarkan ID
$query = mysqli_query($koneksi, "SELECT * FROM lapangan WHERE id_lapangan = '$id_lapangan'"); // query ← EXECUTE "SELECT * FROM lapangan WHERE id_lapangan = id_lapangan"
$data = mysqli_fetch_assoc($query); // data ← Ambil hasil dari query

// Hapus file terkait jika ada
if (!empty($data['gambar'])) { // IF data['gambar'] TIDAK KOSONG THEN
    unlink("uploads/" . $data['gambar']); // HAPUS file "uploads/" + data['gambar']
}

// Hapus data dari database
mysqli_query($koneksi, "DELETE FROM lapangan WHERE id_lapangan = '$id_lapangan'"); // EXECUTE "DELETE FROM lapangan WHERE id_lapangan = id_lapangan"

// Redirect kembali ke halaman utama dengan pesan sukses
echo "<script>
        alert('Data berhasil dihapus!'); // TAMPILKAN pesan "Data berhasil dihapus!"
        window.location = 'lapangan.php'; // ARAHKAN ke halaman lapangan.php
      </script>";
?>

