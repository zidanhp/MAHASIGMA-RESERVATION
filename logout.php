<?php
/*
Pseudocode:

1. Mulai session pengguna
    - Mulai session untuk mengakses data session yang sudah ada.

2. Cek apakah pengguna sudah login
    - Jika session 'username' tidak ada, arahkan pengguna ke halaman login.

3. Logout pengguna
    - Kosongkan semua data session dengan session_unset().
    - Hancurkan session dengan session_destroy().
    - Tampilkan pesan alert bahwa pengguna berhasil logout.
    - Arahkan pengguna ke halaman landing_page.php setelah logout.

*/
session_start();
if (!isset($_SESSION['username'])) {
header("Location: login.php");
exit();
}
?>

<?php
session_unset();
session_destroy();
echo "<script>
    alert('Anda berhasil logout!');
    window.location.href = 'landing_page.php';
</script>";
exit();
?>
