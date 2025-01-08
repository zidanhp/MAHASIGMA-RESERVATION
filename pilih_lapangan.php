<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['id_lapangan'] = $_POST['id_lapangan'];
    $_SESSION['gambar'] = $_POST['gambar'];
    $_SESSION['nama_pemesan'] = $_POST['nama_pemesan'];
    $_SESSION['harga'] = $_POST['harga'];
    $_SESSION['nama_lapangan'] = $_POST['nama_lapangan'];
    $_SESSION['kategori'] = $_POST['kategori'];
    $_SESSION['tanggal_pemesanan'] = $_POST['tanggal_pemesanan'];
}

$id_lapangan = $_SESSION['id_lapangan'];  // Ambil id_lapangan dari session
$query = "SELECT * FROM lapangan WHERE id_lapangan = '$id_lapangan'";
$result = $koneksi->query($query);

// Debug: pastikan data yang diambil
if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
}

$tanggal_pemesanan = $_SESSION['tanggal_pemesanan'] ?? '';
$nama_lapangan = $_SESSION['nama_lapangan'] ?? '';

// Query untuk mengecek jam yang sudah dipesan pada tanggal yang dipilih
$query = "SELECT jam FROM pemesan WHERE DATE(tanggal_pemesanan) = ? AND nama_lapangan = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("ss", $tanggal_pemesanan, $nama_lapangan);  // Menggunakan tanggal yang dipilih oleh pengguna
$stmt->execute();
$result = $stmt->get_result();

$bookedSlots = [];
while ($row = $result->fetch_assoc()) {
    $bookedSlots[] = $row['jam'];
    // Ambil tanggal saja dari tanggal_pemesanan (tanpa jam)
}

// Daftar slot waktu
$jam = [
    "12:00-13:00" => 50000,
    "13:00-14:00" => 50000,
    "14:00-15:00" => 60000,
    "15:00-16:00" => 60000,
    "16:00-17:00" => 70000,
    "17:00-18:00" => 70000,
    "18:00-19:00" => 80000,
    "19:00-20:00" => 80000,
    "20:00-21:00" => 90000,
    "21:00-22:00" => 90000,
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Lapangan</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .container {
        background-color: rgb(231, 231, 231);
        margin-bottom: 4%;
        border-radius: 20px;
        padding: 30px;
    }

    .time-slot {
        display: inline-block;
        margin: 5px;
        padding: 10px;
        border: 2px solid #ccc;
        border-radius: 5px;
    }

    input[type="radio"] {
        background-color: #00a651;
        display: none;
    }

    input[type="radio"]:checked+label {
        background-color: rgb(38, 136, 41);
        color: black;
        border-color: rgb(16, 90, 18);
    }

    label.disabled {
        background-color: #ccc;
        color: #888;
        border-color: #ccc;
        pointer-events: none;
    }

    .jam .text-center {
        margin: 30px;
    }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Pilih Lapangan</h2>
        <form method="POST" action="detail_pesanan.php">
            <div class="row">
                <div class="col-md-6">
                <img src="uploads/<?= htmlspecialchars($_SESSION['gambar']) ?>" alt="Gambar Lapangan" class="card-img-top img-fluid">
                </div>
                <div class="col-md-6">
                    <h3> <?= htmlspecialchars($_SESSION['nama_lapangan']) ?></h3>
                    <p><strong>Nama Pemesan:</strong> <?= htmlspecialchars($_SESSION['nama_pemesan']) ?></p>
                    <p><strong>Kategori:</strong> <?= htmlspecialchars($_SESSION['kategori']) ?></p>
                    <p><strong>Nama Pemesan:</strong> <?= htmlspecialchars($_SESSION['tanggal_pemesanan']) ?></p>
                    <p><strong>Deskripsi:</strong> <?php echo htmlspecialchars($data['deskripsi']); ?></p>
                    <p><strong>Fasilitas:</strong> <?php echo htmlspecialchars($data['fasilitas']); ?></p>
                </div>
            </div>
            <div class="jam">
                <h4 for="jam" class="text-center">Jam:</h4>
                <?php foreach ($jam as $slot => $price): ?>
                <input type="radio" id="slot<?= $slot ?>" name="jam" value="<?= $slot ?>"
                    <?= in_array($slot, $bookedSlots) ? 'disabled' : '' ?>>
                <label for="slot<?= $slot ?>" class="time-slot <?= in_array($slot, $bookedSlots) ? 'disabled' : '' ?>">
                    <?= $slot ?>
                </label>
                <?php endforeach; ?>
                <p><strong>Harga:</strong> Rp. <?= number_format($_SESSION['harga'], 0, ',', '.'); ?> /Jam</p>
                <button type="submit" class="btn btn-success">Pilih
                    Jam</button>
                <a href="menu_lapangan.php" class="btn btn-secondary">Kembali</a>
                <br><br>
            </div>
        </form>
    </div>
</body>

</html>