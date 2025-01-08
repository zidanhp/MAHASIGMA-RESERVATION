<?php
session_start();
require 'koneksi.php'; // Pastikan file koneksi database sudah benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit-otp'])) {
        // Step 1: Input nomor handphone untuk kirim OTP
        $no_handphone = mysqli_escape_string($koneksi, $_POST['no_handphone']);
        if ($no_handphone) {
            // Hapus OTP lama (jika ada)
            mysqli_query($koneksi, "DELETE FROM otp_code WHERE no_handphone = '$no_handphone'");

            // Generate OTP dan waktu
            $otp = rand(100000, 999999);
            $waktu = time();

            // Simpan OTP ke database
            mysqli_query($koneksi, "INSERT INTO otp_code (no_handphone, otp, created_at) VALUES ('$no_handphone', '$otp', NOW())");

            // Kirim OTP menggunakan API Fonnte
            $curl = curl_init();
            $data = [
                'target' => $no_handphone,
                'message' => "Hai maaf mengganggu, OTP anda adalah: $otp"
            ];
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: 4VomUsrKuVu9S4E65NY9"));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_URL, "https://api.fonnte.com/send");
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            $result = curl_exec($curl);
            curl_close($curl);

            // Simpan nomor ke session untuk step selanjutnya
            $_SESSION['no_handphone'] = $_POST['no_handphone'];

            // Redirect ke halaman input OTP
            header('Location: masukkan_otp.php');
            exit;
        }
    } elseif (isset($_POST['submit-login'])) {
        // Step 2: Verifikasi OTP
        $otp = mysqli_escape_string($koneksi, $_POST['otp']);
        $no_handphone = $_SESSION['no_handphone'];

        // Cek OTP di database
        $q = mysqli_query($koneksi, "SELECT * FROM otp_code WHERE no_handphone = '$no_handphone' AND otp = '$otp'");
        $row = mysqli_fetch_assoc($q);

        if ($row) {
            // Cek waktu OTP (valid 5 menit)
            if (time() - strtotime($row['created_at']) <= 300) {
                // OTP benar, redirect ke halaman ganti_sandi
                echo "<script>alert('Kode OTP sudan sesuai. Silakan coba ganti sandi.');window.location.href = 'ganti_sandi_otp.php';</script>";
                exit;
            } else {
                echo "<script>alert('Kode OTP telah kedaluwarsa. Silakan coba lagi.');window.location.href = 'masukkan_otp.php';</script>";
                exit;
            }
        } else {
            echo "<script>alert('Kode OTP salah. Silakan coba lagi.');window.location.href = 'masukkan_otp.php';</script>";
            exit;
        }
    }
}
?>