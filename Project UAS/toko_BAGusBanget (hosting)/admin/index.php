<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['level'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin - BAGus Banget</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="centered-body">
    <div class="admin-dashboard">
        <h2>Selamat datang, Admin <?= $_SESSION['user']['nama'] ?>!</h2>
        <ul class="admin-menu">
            <li><a href="produk.php" class="btn">Manajemen Produk</a></li>
            <li><a href="kategori.php" class="btn">Manajemen Kategori</a></li>
            <li><a href="../auth/logout.php" class="btn">Logout</a></li>
        </ul>
    </div>
</body>
</html>
