<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_lapangan = $_POST['id_lapangan'];
    $nama_lapangan = $_POST['nama_lapangan'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $fasilitas = $_POST['fasilitas'];
    
    // Cek apakah ada gambar baru yang diupload
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
        // Proses upload gambar baru
        $gambar = $_FILES['gambar']['name'];
        $target = 'uploads/' . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target);
    } else {
        // Jika tidak ada gambar baru, gunakan gambar yang sudah ada
        $gambar = $_POST['current_image'];
    }

    // Update data lapangan di database
    $query = "UPDATE lapangan SET 
                nama_lapangan = '$nama_lapangan', 
                kategori = '$kategori', 
                harga = '$harga', 
                gambar = '$gambar', 
                deskripsi = '$deskripsi', 
                fasilitas = '$fasilitas' 
              WHERE id_lapangan = '$id_lapangan'";

    if (mysqli_query($koneksi, $query)) {
        // Set session untuk konfirmasi
        session_start();
        $_SESSION['edit_success'] = true;
        echo "<script>alert('Data lapangan berhasil diperbarui!'); window.location.href='lapangan.php';</script>";
        exit();
    } else {
        // Jika query gagal
        echo "<script>alert('Terjadi kesalahan saat memperbarui data lapangan.'); window.location.href='lapangan.php';</script>";
        exit();
    }
} else {
    // Jika request bukan POST, redirect ke lapangan.php
    header('Location: lapangan.php');
    exit();
}
?>