<?php
session_start();
require '../db.php';

$kategori = $koneksi->query("SELECT * FROM kategori")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $kategori_id = $_POST['kategori_id'];

    $nama_file = $_FILES['gambar']['name'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp_file, "../img/" . $nama_file);

    $stmt = $koneksi->prepare("INSERT INTO produk (nama_produk, harga, gambar, kategori_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nama, $harga, $nama_file, $kategori_id]);

    header("Location: produk.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk - Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="admin-body">
    <div class="admin-container">
        <h2>Tambah Produk</h2>

        <form method="POST" enctype="multipart/form-data" class="form-admin">
            <input type="text" name="nama" placeholder="Nama Produk" required class="input-box"><br>
            <input type="number" name="harga" placeholder="Harga" required class="input-box"><br>
            <select name="kategori_id" required class="input-box">
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
                <?php endforeach; ?>
            </select><br>
            <input type="file" name="gambar" required class="input-box"><br>
            <button type="submit" name="simpan" class="btn">Simpan</button>
        </form>
    </div>
</body>
</html>
