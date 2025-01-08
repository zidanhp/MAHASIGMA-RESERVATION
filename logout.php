<?php
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
