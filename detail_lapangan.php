<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

$id_lapangan = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Menggunakan prepared statement untuk keamanan
$stmt = $koneksi->prepare("SELECT * FROM lapangan WHERE id_lapangan = ?");
$stmt->bind_param("i", $id_lapangan);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
} else {
    echo "Data lapangan tidak ditemukan!";
    exit();
}

// Dapatkan tanggal hari ini dalam format YYYY-MM-DD
$currentDate = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lapangan</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .container {
        background-color: rgb(231, 231, 231);
        margin-bottom: 4%;
        border-radius: 20px;
        padding: 30px;
    }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Detail Lapangan</h2>
        <div class="row">
            <div class="col-md-6">  
            <img src="uploads/<?php echo $data['gambar']; ?>" alt="Gambar Lapangan" class="card-img-top img-fluid">
            </div>
            <div class="col-md-6">
                <form method="POST" action="pilih_lapangan.php">
                    <h3><?php echo htmlspecialchars($data['nama_lapangan']); ?></h3>
                    <p><strong>Harga:</strong> Rp. <?php echo number_format($data['harga'], 0, ',', '.'); ?> /Jam</p>
                    <p><strong>Kategori:</strong> <?php echo htmlspecialchars($data['kategori']); ?></p>
                    <p><strong>Deskripsi:</strong> <?php echo htmlspecialchars($data['deskripsi']); ?></p>
                    <p><strong>Fasilitas:</strong> <?php echo htmlspecialchars($data['fasilitas']); ?></p>

                    <input type="hidden" name="id_lapangan" value="<?= htmlspecialchars($data['id_lapangan']); ?>">
                    <input type="hidden" name="gambar" value="<?= htmlspecialchars($data['gambar']); ?>">
                    <input type="hidden" name="nama_pemesan" value="<?= htmlspecialchars($_SESSION['username']); ?>">
                    <input type="hidden" name="harga" value="<?= htmlspecialchars($data['harga']); ?>">
                    <input type="hidden" name="nama_lapangan" value="<?= htmlspecialchars($data['nama_lapangan']); ?>">
                    <input type="hidden" name="kategori" value="<?= htmlspecialchars($data['kategori']); ?>">

                    <label for="tanggal_pemesanan">Tanggal:</label>
                    <input type="date" id="tanggal_pemesanan" name="tanggal_pemesanan" required
                        min="<?= $currentDate ?>"></br></br>
                    <button type="submit" class="btn btn-success">Pilih Tanggal</button>
                    <a href="menu_lapangan.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
