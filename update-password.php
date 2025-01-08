<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['no_handphone'])) {
        echo "Nomor handphone tidak tersedia di session.";
        exit();
    }

    $no_handphone = $_SESSION['no_handphone'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    echo "Nomor Handphone Input: $no_handphone<br>";

    if ($new_password === $confirm_password) {
        // Cek apakah nomor handphone ada di database
        $check_user = $koneksi->prepare("SELECT * FROM user WHERE TRIM(no_handphone) = ?");
        $check_user->bind_param("s", $no_handphone);
        $check_user->execute();
        $result = $check_user->get_result();

        if ($result->num_rows == 0) {
            echo "Nomor handphone tidak ditemukan.";
            exit();
        }

        // Debugging: Cetak data user dari database
        $user = $result->fetch_assoc();
        echo "Data User: ";
        print_r($user);

        // Cek apakah password baru sama dengan password lama
        if (password_verify($new_password, $user['password'])) {
            echo "Password baru tidak boleh sama dengan password lama.";
            exit();
        }

        // Hash password baru
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password di tabel user
        $query = $koneksi->prepare("UPDATE user SET password = ? WHERE no_handphone = ?");
        $query->bind_param("ss", $hashed_password, $no_handphone);

        if ($query->execute()) {
            if ($query->affected_rows > 0) {
                echo "<script>
                alert('Password berhasil diubah');
                window.location.href = 'login.php';
            </script>";
                exit();
            } else {
                echo "Gagal mengubah password.";
            }
        } else {
            echo "Gagal mengubah password: " . $query->error;
        }
    } else {
        echo "Password dan konfirmasi password tidak cocok.";
    }
}
?>