<?php
session_start();
require 'db.php';

// Ambil semua kategori
$kategori = $koneksi->query("SELECT * FROM kategori")->fetchAll(PDO::FETCH_ASSOC);

// Ambil produk berdasarkan kategori (jika ada)
$where = "";
if (isset($_GET['kategori_id'])) {
    $kategori_id = (int) $_GET['kategori_id'];
    $where = "WHERE kategori_id = $kategori_id";
}

$produk = $koneksi->query("SELECT * FROM produk $where ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>BAGus Banget</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="navbar">
        <h1>BAGus Banget</h1>
        <div>
            <a href="auth/login.php">Login</a>
            <a href="keranjang/index.php">Keranjang</a>
        </div>
    </div>

    <div class="kategori">
        <h2>Kategori Tas</h2>
        <ul>
            <li><a href="index.php">Semua</a></li>
            <?php foreach ($kategori as $k): ?>
                <li><a href="index.php?kategori_id=<?= $k['id'] ?>"><?= $k['nama'] ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="produk-container">
        <?php if (count($produk) > 0): ?>
            <?php foreach ($produk as $p): ?>
                <div class="produk-item">
                    <img src="img/<?= $p['gambar'] ?>" alt="<?= $p['nama_produk'] ?>">
                    <h3><?= $p['nama_produk'] ?></h3>
                    <p>Rp <?= number_format($p['harga'], 0, ',', '.') ?></p>
                    <a href="keranjang/tambah.php?id=<?= $p['id'] ?>" class="btn">Tambah ke Keranjang</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="produk-kosong">Tidak ada produk ditemukan.</p>
        <?php endif; ?>
    </div>
</body>
</html>
