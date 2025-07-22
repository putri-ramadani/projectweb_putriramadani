<?php
session_start();
require '../db.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];
$produk_id = $_GET['id'];

// cek apakah produk sudah ada di keranjang
$cek = $koneksi->prepare("SELECT * FROM keranjang WHERE user_id = ? AND produk_id = ?");
$cek->execute([$user_id, $produk_id]);

if ($cek->rowCount() > 0) {
    $koneksi->prepare("UPDATE keranjang SET jumlah = jumlah + 1 WHERE user_id = ? AND produk_id = ?")
        ->execute([$user_id, $produk_id]);
} else {
    $koneksi->prepare("INSERT INTO keranjang (user_id, produk_id, jumlah) VALUES (?, ?, 1)")
        ->execute([$user_id, $produk_id]);
}

header("Location: index.php");
