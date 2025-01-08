<?php 
// Memasukkan koneksi database
include 'koneksi.php';


$id_lapangan = $_GET['id_lapangan'];

$query = mysqli_query($koneksi, "SELECT * FROM lapangan WHERE id_lapangan = '$id_lapangan'");
$data = mysqli_fetch_assoc($query);

// Hapus file terkait jika ada
if (!empty($data['gambar'])) {
    unlink("uploads/" . $data['gambar']);
}

// Hapus data dari database
mysqli_query($koneksi, "DELETE FROM lapangan WHERE id_lapangan = '$id_lapangan'");
// Redirect kembali ke halaman utama dengan pesan sukses
echo "<script>
        alert('Data berhasil dihapus!');
        window.location = 'lapangan.php';
      </script>";
?>
