<?php
include 'koneksi.php';

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Memperbarui status di database
    $query = "UPDATE pemesan SET status_bayar = '$status' WHERE id = $id";
    if (mysqli_query($koneksi, $query)) {
        echo json_encode(['status' => $status]);
    } else {
        echo json_encode(['status' => 'error']);
    }
}
?>
