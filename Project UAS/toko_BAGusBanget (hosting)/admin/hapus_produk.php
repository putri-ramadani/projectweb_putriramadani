<?php
session_start();
require '../db.php';

if (!isset($_GET['id'])) {
    header("Location: produk.php");
    exit;
}

$id = $_GET['id'];
$koneksi->query("DELETE FROM produk WHERE id = $id");

header("Location: produk.php");
