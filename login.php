
<?php
include 'koneksi.php';
// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Sertakan koneksi
session_start();

// Jika pengguna sudah login, arahkan ke halaman beranda
if (isset($_SESSION['username'])) {
    header("Location: beranda.php"); // Ganti dengan nama file beranda Anda
    exit();
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Ambil data user berdasarkan username
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $data['password'])) {
            // Login berhasil
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = $data['role'];

            if ($data['role'] === 'admin') {
                header("Location: dashboard.php");
            } else {
                header("Location: beranda.php");
            }
            exit;
        } else {
            echo "<script>alert('Password salah!'); window.location.href = 'login.php';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!'); window.location.href = 'login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mahasigma Reservation - Login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="./image/favico.ico">
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
      text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6); /* Thicker and darker shadow */
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
        <img src="./image/logo.png" alt="Mahasigma Reservation Logo" class="logo" />
        <h2>Login</h2>
        <form action="login.php" method="post">
      
      <input
            type="text"
            class="form-control"
            id="username"
            placeholder="Masukkan nama pengguna"
            name="username"
            required
          />
          <div class="password-wrapper">
            <input
              type="password"
              class="form-control"
              id="password"
              placeholder="Masukkan kata sandi"
              name="password"
              required
            />
            <span class="toggle-password">
              <i class="fas fa-eye" id="togglePassword"></i>
            </span>
          </div>
          <button name="login" type="submit" class="btn btn-primary w-100">
            <i class="fas fa-sign-in-alt"></i> Masuk
          </button>
          <a href="lupa_sandi.php" class="forgot-password">Lupa kata sandi?</a>
          <p>
            Belum punya akun?
            <a href="daftar.php" class="signup-link">Daftar sekarang</a>
          </p>
        </form>
      </div>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
      document
        .getElementById("togglePassword")
        .addEventListener("click", function () {
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
