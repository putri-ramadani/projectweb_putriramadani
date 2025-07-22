<?php
session_start();
require '../db.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}

$id_user = $_SESSION['user']['id'];
$keranjang = $koneksi->query("SELECT k.*, p.nama_produk, p.harga, p.gambar 
    FROM keranjang k JOIN produk p ON k.produk_id = p.id 
    WHERE k.user_id = $id_user")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="admin-body">
    <div class="admin-container">
        <h2>Keranjang Belanja</h2>

        <table class="tabel-admin">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                foreach ($keranjang as $item): 
                    $subtotal = $item['jumlah'] * $item['harga'];
                    $total += $subtotal;
                ?>
                <tr>
                    <td><?= $item['nama_produk'] ?></td>
                    <td><?= $item['jumlah'] ?></td>
                    <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                    <td><a href="hapus.php?id=<?= $item['id'] ?>" class="btn small danger" onclick="return confirm('Hapus?')">Hapus</a></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2"><strong>Total</strong></td>
                    <td colspan="2"><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></td>
                </tr>
            </tbody>
        </table>

        <br>
        <a href="../checkout/index.php" class="btn">Lanjut ke Checkout</a>
    </div>
</body>
</html>
