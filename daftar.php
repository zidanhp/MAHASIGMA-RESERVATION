
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasigma Reservation - Daftar</title>
    <link rel="stylesheet" href="daftar.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
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

        .form-container {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        backdrop-filter: blur(5px);
    }

        .registrasi-box {
        background: rgba(255, 255, 255, 0.8);
        padding: 60px;
        border-radius: 10px;
        text-align: center;
        width: 450px;
    }

        .registrasi-box h2 {
        margin-bottom: 25px;
        font-size: 26px;   
    }

        .form-control {
        width: 100%;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 18px;
    }

        .form-control:focus {
        border-color: #4caf50;
        outline: none;
    }

        .password-wrapper {
        position: relative;
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

        .form-checkbox {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
        font-size: 16px;
    }

        .form-checkbox input {
        margin-right: 10px;
    }

        .submit-button {
        background-color: #4caf50;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 15px;
        width: 100%;
        cursor: pointer;
        font-size: 18px;
    }
    
        .submit-button:hover {
        background-color: #45a049;
    }
    </style>
</head>
<body>

<div class="form-container">
    <div class="registrasi-box">
        <img src="./image/logo.png" alt="Mahasigma Reservation Logo" class="logo">
        <h2>Daftar</h2>
        <form action="register.php" method="post">
            <input type="text" class="form-control" placeholder="Nama Pengguna" name="username" required>
            <input type="text" class="form-control" placeholder="Nomor Handphone" name="no_handphone" required>
            <div class="password-wrapper">
                <input type="password" class="form-control" placeholder="Kata Sandi" id="password" name="password" required>
                <span class="toggle-password" id="togglePassword"><i class="fas fa-eye"></i></span>
            </div>
            <div class="password-wrapper">
                <input type="password" class="form-control" placeholder="Konfirmasi Kata Sandi" id="confirmPassword" name="confirm_password" required>
                <span class="toggle-password" id="toggleConfirmPassword"><i class="fas fa-eye"></i></span>
            </div>
            <div class="form-checkbox">
                <input type="checkbox" id="validData" required />
                <label for="validData">Isi data dengan valid</label>
            </div>
            <button type="submit" class="submit-button" name="register">Daftar</button>
        </form>
    </div>
</div>

<script>
    // Script untuk toggle password
    document.getElementById("togglePassword").addEventListener("click", function () {
        const passwordInput = document.getElementById("password");
        passwordInput.type = passwordInput.type === "password" ? "text" : "password";
    });

    document.getElementById("toggleConfirmPassword").addEventListener("click", function () {
        const confirmPasswordInput = document.getElementById("confirmPassword");
        confirmPasswordInput.type = confirmPasswordInput.type === "password" ? "text" : "password";
    });
</script>

</body>
</html>