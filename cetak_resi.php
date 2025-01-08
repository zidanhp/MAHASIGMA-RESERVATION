<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ambil data dari session
$nama_pemesan = $_SESSION['nama_pemesan'] ?? 'N/A';
$nama_lapangan = $_SESSION['nama_lapangan'] ?? 'N/A';
$kategori = $_SESSION['kategori'] ?? 'N/A';
$tanggal_pemesanan = $_SESSION['tanggal_pemesanan'] ?? 'N/A';
$jam = $_SESSION['jam'] ?? 'N/A';
$harga = $_SESSION['harga'] ?? 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resi Pemesanan Lapangan</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      background-color: #f9f9f9;
    }
    .resi-container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 10px;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .resi-header {
      text-align: center;
      margin-bottom: 20px;
    }
    .resi-header h1 {
      font-size: 24px;
      color: #333;
      margin: 0;
    }
    .resi-header p {
      font-size: 14px;
      color: #666;
    }
    .resi-section {
      margin-bottom: 15px;
    }
    .resi-section h2 {
      font-size: 18px;
      color: #333;
      border-bottom: 2px solid #ddd;
      padding-bottom: 5px;
      margin-bottom: 10px;
    }
    .resi-section p {
      font-size: 14px;
      color: #555;
      margin: 5px 0;
    }
    .resi-footer {
      text-align: center;
      margin-top: 20px;
      font-size: 12px;
      color: #777;
    }
    .print-button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 20px;
  }

  /* CSS untuk tampilan cetak */
  @media print {
    .print-button {
      display: none; /* Sembunyikan tombol cetak */
    }
    body {
      margin: 0;
      padding: 0;
      background-color: white;
    }
    .resi-container {
      border: none;
      box-shadow: none;
      margin: 0;
      padding: 0;
    }
    .resi-header h1 {
      font-size: 20px;
    }
    .resi-section h2 {
      font-size: 16px;
    }
    .resi-section p {
      font-size: 12px;
    }
  }
  </style>
</head>
<body>
  <div class="resi-container">
    <div class="resi-header">
      <h1>Resi Pemesanan Lapangan</h1>
      <p>Tanggal: <?php echo date('d-m-Y'); ?></p>
    </div>

    <div class="resi-section">
      <h2>Data Pemesan</h2>
      <p>Nama: <?php echo htmlspecialchars($nama_pemesan); ?></p>
    </div>

    <div class="resi-section">
      <h2>Data Lapangan</h2>
      <p>Nama Lapangan: <?php echo htmlspecialchars($nama_lapangan); ?></p>
      <p>Jenis Lapangan: <?php echo htmlspecialchars($kategori); ?></p>
      <p>Tanggal Booking: <?php echo htmlspecialchars($tanggal_pemesanan); ?></p>
      <p>Waktu Booking: <?php echo htmlspecialchars($jam); ?></p>
    </div>

    <div class="resi-section">
      <h2>Rincian Pembayaran</h2>
      <p>Harga Sewa: Rp. <?php echo number_format($harga, 0, ',', '.'); ?></p>
      <p>Total Pembayaran: Rp. <?php echo number_format($harga, 0, ',', '.'); ?></p>
      <p>Metode Pembayaran: Tunai</p>
    </div>

    <div class="resi-footer">
  <button onclick="window.print()" class="print-button">Cetak Resi</button>
  <button class="print-button">
    <a href="pesanan.php" class="text-white">Kembali</a>
  </button>
  <div class="copyright text-center text-white py-2">
    <p class="mb-0">&copy; 2024 MAHASIGMA RESERVATION. All rights reserved.</p>
  </div>
</div>
  </div>
</body>
</html>