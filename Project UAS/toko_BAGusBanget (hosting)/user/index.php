<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman User</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="centered-body">
    <div class="user-container">
        <h2>Hai, <?= $_SESSION['user']['nama'] ?>!</h2>
        <p>Selamat datang di <strong>BAGus Banget</strong> 👋</p>
        <a href="../index.php" class="btn">Belanja Sekarang</a>
        <a href="../keranjang/index.php" class="btn">Lihat Keranjang</a>
        <a href="../auth/logout.php" class="btn">Logout</a>
    </div>
</body>
</html>
