
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "dbmahasigma"; // Nama Database
// Melakukan koneksi ke db
$koneksi = mysqli_connect($host, $user, $pass, $db);
if(!$koneksi){
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>