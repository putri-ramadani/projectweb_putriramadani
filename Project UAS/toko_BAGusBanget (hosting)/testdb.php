<?php
$host = 'sql308.infinityfree.com';
$dbname = 'if0_39518355_bagusbanget';
$username = 'if0_39518355';
$password = 'TZnfMBGtJF';

try {
    $koneksi = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    echo "Koneksi berhasil!";
} catch(PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}
?>
