<?php
session_start();
require '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['level'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

// Tambah kategori
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $stmt = $koneksi->prepare("INSERT INTO kategori(nama) VALUES(?)");
    $stmt->execute([$nama]);
    header("Location: kategori.php");
}

// Hapus kategori
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $koneksi->query("DELETE FROM kategori WHERE id = $id");
    header("Location: kategori.php");
}

$kategori = $koneksi->query("SELECT * FROM kategori")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Kategori</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="admin-body">
    <div class="admin-container">
        <h2 style="text-align: center;">Manajemen Kategori</h2>
        <form method="POST" class="form-admin">
            <input type="text" name="nama" placeholder="Nama Kategori" class="input-box" required>
            <button type="submit" name="tambah" class="btn">Tambah</button>
        </form>

        <table class="tabel-admin">
            <tr>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
            <?php foreach ($kategori as $k): ?>
            <tr>
                <td><?= $k['nama'] ?></td>
                <td>
                    <a href="?hapus=<?= $k['id'] ?>" class="btn danger small" onclick="return confirm('Yakin?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
