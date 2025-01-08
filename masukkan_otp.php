<?php
session_start();
if (isset($_GET['no_handphone'])) {
    $_SESSION['no_handphone'] = $_GET['no_handphone'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lupa Kata Sandi</title>
    <link rel="stylesheet" href="login.css" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
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

    .login-box input[type="text"] {
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

    .box p {
        font-size: 16px;

    }

    .login-box p a {
        color: #0000ee;
        text-decoration: none;
        font-size: 16px;
        padding-bottom: 20px;
    }

    .signup-link {
        color: #0000ee;
        text-decoration: none;
        font-size: 16px;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6);
        /* Thicker and darker shadow */
    }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <img src="./image/logo.png" alt="Mahasigma Reservation Logo" class="logo">
            <form action="otp.php" method="POST">
                <label for="otp" class="form-label">Masukkan Kode OTP Anda</label>
                <input type="text" class="form-control" placeholder="Masukkan Kode OTP Anda" name="otp"
                    required>
                <p>Kode OTP terdiri dari 6 karakter </p>
                <button type="submit" class="btn btn-primary w-100" name="submit-login">
                    <i class="fas fa-paper-plane"></i>Kirim</button>
            </form>
        </div>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>