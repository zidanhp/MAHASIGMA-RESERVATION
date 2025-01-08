<?php
// Pseudocode untuk fitur "Tambah Lapangan":
// 1. Ambil data yang dikirimkan dari form menggunakan metode POST:
//    - Nama lapangan
//    - Harga
//    - Fasilitas
//    - Deskripsi
//    - Gambar lapangan yang diupload
// 2. Tentukan folder tujuan untuk menyimpan gambar, yaitu folder 'uploads/'.
// 3. Pindahkan gambar yang diupload dari direktori sementara ke folder 'uploads/'.
// 4. Jika proses upload gambar berhasil, lanjutkan dengan query untuk menyimpan data lapangan:
//    - Masukkan data lapangan ke dalam tabel 'lapangan' (nama lapangan, harga, gambar, fasilitas, deskripsi).
// 5. Jika query berhasil dijalankan, alihkan pengguna ke halaman 'lapangan.php'.
// 6. Jika terjadi kesalahan, tampilkan pesan error.
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
