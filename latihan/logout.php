<?php
session_start();
// Hapus semua sesi
session_unset();
session_destroy();
// Arahkan pengguna kembali ke halaman login
header("Location: login.php");
exit;
?>
