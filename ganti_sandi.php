<?php
/*
Pseudocode:

1. Mulai session pengguna
    - Mulai session untuk mengakses data pengguna yang sedang login.

2. Cek apakah pengguna sudah login
    - Jika session 'username' tidak ada, arahkan pengguna ke halaman login.

3. Ambil data pengguna dari database
    - Ambil username pengguna dari session.
    - Query database untuk mengambil data pengguna berdasarkan username yang ada di session.

4. Tampilkan halaman ubah kata sandi
    - Ambil nomor handphone pengguna dari data yang diambil untuk keperluan verifikasi (jika diperlukan).
    - Tampilkan form untuk mengubah kata sandi (input password baru dan konfirmasi password baru).

5. Kirimkan data ke halaman untuk memproses perubahan kata sandi
    - Form akan mengirimkan data ke halaman update_password.php untuk memperbarui kata sandi pengguna.

6. JavaScript untuk toggle password visibility
    - Implementasikan fungsi untuk menampilkan dan menyembunyikan kata sandi dengan mengklik ikon mata (toggle password).

*/
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

$query = "SELECT * FROM user";

$username = $_SESSION['username'];  // Ambil username dari session
$query = "SELECT * FROM user WHERE username = '$username'";
$result = $koneksi->query($query);

// Debug: pastikan data yang diambil
if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    body {
        background-image: url("./image/background.jpg");
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .logo {
        position: absolute;
        bottom: 10px;
        left: 10px;
        width: 250px;
        height: auto;
    }

    .login-container {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        backdrop-filter: blur(5px);
    }

    .login-box {
        background: rgba(255, 255, 255, 0.8);
        padding: 60px;
        border-radius: 10px;
        text-align: center;
        width: 450px;
    }

    .login-box h2 {
        margin-bottom: 25px;
        font-size: 26px;
    }

    .login-box input[type="text"],
    .login-box input[type="password"] {
        width: 100%;
        padding: 15px;
        margin: 30px 0 35px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .login-box button {
        width: 100%;
        padding: 15px;
        background-color: #4caf50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 20px;
    }

    .login-box button:hover {
        background-color: #45a049;
    }

    .btn-primary i {
        margin-right: 8px;
    }

    .login-box p {
        margin-top: 20px;
        font-size: 16px;
    }

    .login-box p a {
        color: #0000ee;
        text-decoration: none;
        font-size: 16px;
    }

    .forgot-password {
        display: block;
        margin-top: 15px;
        color: #0000ee;
        text-decoration: none;
        font-size: 16px;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6);
    }

    .signup-link {
        color: #0000ee;
        text-decoration: none;
        font-size: 16px;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6);
        /* Thicker and darker shadow */
    }

    .password-wrapper {
        position: relative;
    }

    .password-wrapper input {
        padding-right: 50px;
    }

    .toggle-password {
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #888;
    }

    .toggle-password:hover {
        color: #333;
    }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-box">
        <img src="./image/logo.png" alt="Mahasigma Reservation Logo" class="logo">            
        <h1>Kata Sandi Baru</h1>
            <form action="update_password.php" method="post">
                <input type="password" class="form-control" id="new_password" placeholder="Masukkan Kata Sandi Baru"
                    name="new_password" required>
                <div class="password-wrapper">
                    <input type="password" class="form-control" id="confirm_password"
                        placeholder="Konfirmasi Kata Sandi Baru" name="confirm_password" required>
                </div>
                <input type="hidden" name="no_handphone" value="<?= htmlspecialchars($data['no_handphone']); ?>">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa"></i>Ubah</button>
            </form>
        </div>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
    document
        .getElementById("togglePassword")
        .addEventListener("click", function() {
            const passwordInput = document.getElementById("password");
            const icon = this;
            passwordInput.type =
                passwordInput.type === "password" ? "text" : "password";
            icon.classList.toggle("fa-eye");
            icon.classList.toggle("fa-eye-slash");
        });
    </script>
</body>

</html>
