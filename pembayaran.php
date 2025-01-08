<?php
session_start();
if (!isset($_SESSION['username'])) {
header("Location: login.php");
exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasigma Reservation</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #28a745;
    padding: 10px 20px;
    color: white;
}

header .logo {
    font-size: 20px;
    font-weight: bold;
}

header nav a {
    margin: 0 10px;
    text-decoration: none;
    color: white;
    font-weight: bold;
}

header .search-profile {
    display: flex;
    align-items: center;
}

header .search-profile input {
    padding: 5px;
    margin-right: 10px;
    border-radius: 5px;
    border: none;
}

main {
    padding: 20px;
    text-align: center;
}
.button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}
.button-cancel {
    background-color: #6c757d;
    color: #fff;
}
.button-confirm {
    background-color: #007bff;
    color: #fff;
}
.reservation {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    margin-top: 20px;
}

.reservation .image img {
    width: 300px;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
}

.reservation .details {
    background-color: #f8f8f8;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 300px;
}

.reservation .details h2 {
    margin-bottom: 20px;
    font-size: 18px;
    color: #333;
}

.reservation .details .info p {
    text-align: left;
    margin: 5px 0;
    font-size: 14px;
    color: #555;
}

.reservation .details .total {
    margin: 15px 0;
    font-size: 16px;
    font-weight: bold;
    color: #333;
}

.reservation .details .buttons {
    display: flex;
    justify-content: space-between;
}

.reservation .details .buttons button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.reservation .details .buttons .cancel {
    background-color: #e74c3c;
    color: white;
}

.reservation .details .buttons .confirm {
    background-color: #28a745;
    color: white;
}

footer {
    background-color: #28a745;
    color: white;
    padding: 10px 0;
    text-align: center;
    margin-top: 20px;
}
    </style>
</head>
<body>
    <header>
        <div class="logo">Mahasigma Reservation</div>
        <nav>
            <a href="#">Beranda</a>
            <a href="#">Lapangan</a>
            <a href="#">Pesanan</a>
            <a href="#">Kontak</a>
        </nav>
        <div class="search-profile">
            <input type="text" placeholder="Search">
            <div class="profile-icon">🔍</div>
        </div>
    </header>

    <main>
        <section class="reservation">
            <div class="image">
                <img src="lapangan.jpg" alt="Lapangan">
            </div>
            <div class="details">
                <h2>Transaksi Pemesanan</h2>
                <div class="info">
                    <p>Nama pemesan :</p>
                    <p>Hari dan tanggal pemesanan :</p>
                    <p>Jam :</p>
                    <p>Kode Lapangan :</p>
                </div>
                <div class="total">Total Rp.1xxxxxx</div>
                <div class="actions">
        <button class="button button-cancel" id="cancel-btn">Batal</button>
        <button class="button button-confirm" id="confirm-btn">Konfirmasi Pembayaran</button>
    </div>
            </div>
        </section>
    </main>

    <footer>
        <p>Footer</p>
        <p>Copyright</p>
    </footer>
    <script>
    // Ambil tombol
    const cancelBtn = document.getElementById('cancel-btn');
    const confirmBtn = document.getElementById('confirm-btn');

    // Tambahkan event listener ke tombol Batal
    cancelBtn.addEventListener('click', () => {
        // Pindah ke halaman lapangan.php ketika tombol "Batal" diklik
        window.location.href = 'lapangan.php';
    });

    // Tambahkan event listener ke tombol Konfirmasi Pembayaran
    confirmBtn.addEventListener('click', () => {
        // Logika untuk konfirmasi pembayaran bisa ditambahkan di sini
        alert('Pembayaran berhasil dikonfirmasi!');
    });
</script>
</body>
</html>
