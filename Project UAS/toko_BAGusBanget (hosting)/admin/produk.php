<?php
session_start();
require '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['level'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$produk = $koneksi->query("SELECT p.*, k.nama as nama_kategori FROM produk p JOIN kategori k ON p.kategori_id = k.id")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Produk - Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="admin-body">
    <div class="admin-container">
        <h2>Manajemen Produk</h2>
        <a href="tambah_produk.php" class="btn">+ Tambah Produk</a>

        <table class="tabel-admin">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produk as $p): ?>
                <tr>
                    <td><?= $p['nama_produk'] ?></td>
                    <td><?= $p['nama_kategori'] ?></td>
                    <td>Rp <?= number_format($p['harga'],0,',','.') ?></td>
                    <td><img src="../img/<?= $p['gambar'] ?>" class="admin-img"></td>
                    <td>
                        <a href="edit_produk.php?id=<?= $p['id'] ?>" class="btn small">Edit</a>
                        <a href="hapus_produk.php?id=<?= $p['id'] ?>" class="btn small danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
