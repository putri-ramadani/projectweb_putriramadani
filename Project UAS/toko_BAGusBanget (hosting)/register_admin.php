<?php
require 'db.php';

$nama = 'Admin BAGus';
$email = 'admin@bagus.com';
$password = password_hash('admin123', PASSWORD_DEFAULT);
$level = 'admin';

$stmt = $koneksi->prepare("SELECT * FROM user WHERE email = ?");
$stmt->execute([$email]);
$existing = $stmt->fetch();

if ($existing) {
    echo "<p style='color: orange;'>Admin sudah terdaftar!</p>";
} else {
    $stmt = $koneksi->prepare("INSERT INTO user (nama, email, password, level) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nama, $email, $password, $level]);
    echo "<p style='color: green;'>Admin berhasil ditambahkan! 🎉</p>";
    echo "<p>Email: $email<br>Password: admin123</p>";
}
?>
