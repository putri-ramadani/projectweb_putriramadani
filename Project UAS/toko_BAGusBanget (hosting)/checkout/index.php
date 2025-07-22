<?php
session_start();
require '../db.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}

$id_user = $_SESSION['user']['id'];
$keranjang = $koneksi->query("SELECT * FROM keranjang WHERE user_id = $id_user")->fetchAll(PDO::FETCH_ASSOC);

if (count($keranjang) == 0) {
    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>Checkout</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body class="centered-body">
        <div class="form-box">
            <p>Keranjang kosong. <a href="../index.php" class="btn">Belanja sekarang</a></p>
        </div>
    </body>
    </html>';
    exit;
}

// Proses checkout
if (isset($_POST['checkout'])) {
    foreach ($keranjang as $item) {
        $koneksi->prepare("INSERT INTO pesanan (user_id, produk_id, jumlah, tanggal) VALUES (?, ?, ?, NOW())")
            ->execute([$id_user, $item['produk_id'], $item['jumlah']]);
    }

    $koneksi->query("DELETE FROM keranjang WHERE user_id = $id_user");

    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>Checkout</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body class="centered-body">
        <div class="form-box">
            <p>Checkout berhasil! Terima kasih sudah belanja 😊</p>
            <a href="../index.php" class="btn">Kembali ke Beranda</a>
        </div>
    </body>
    </html>';
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="centered-body">
    <div class="form-box">
        <h2>Checkout</h2>
        <form method="POST">
            <p>Yakin ingin checkout semua barang di keranjang?</p>
            <button type="submit" name="checkout" class="btn">Ya, Checkout Sekarang</button>
        </form>
    </div>
</body>
</html>
