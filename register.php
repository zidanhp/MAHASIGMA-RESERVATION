
<?php
// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Sertakan koneksi
include 'koneksi.php';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $no_handphone = mysqli_real_escape_string($koneksi, $_POST['no_handphone']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($koneksi, $_POST['confirm_password']);

    // Validasi password
    if ($password !== $confirm_password) {
        echo "<script>alert('Kata sandi dan konfirmasi kata sandi tidak cocok.'); window.location.href = 'daftar.php';</script>";
        exit;
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah username sudah ada
    $query_check = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($query_check) > 0) {
        echo "<script>alert('Nama pengguna sudah terdaftar.'); window.location.href = 'daftar.php';</script>";
        exit;
    }

        // Cek apakah nomor handphone sudah terdaftar
        $query_check_phone = mysqli_query($koneksi, "SELECT * FROM user WHERE no_handphone = '$no_handphone'");
        if (mysqli_num_rows($query_check_phone) > 0) {
            echo "<script>alert('Nomor handphone sudah terdaftar.'); window.location.href = 'daftar.php';</script>";
            exit;
        }

    // Simpan data ke database
    $query = "INSERT INTO user (username, no_handphone, password, role) VALUES ('$username', '$no_handphone', '$hashed_password', 'user')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location.href = 'login.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan. Silakan coba lagi.'); window.location.href = 'daftar.php';</script>";
    }
}
?>