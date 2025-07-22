<?php
$host = 'sql308.infinityfree.com';
$dbname = 'if0_39518355_bagusbanget'; // Pastikan ini sesuai nama database kamu
$username = 'if0_39518355';
$password = 'TZnfMBGtJF'; // Pastikan ini password akun InfinityFree kamu

try {
    $koneksi = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>
