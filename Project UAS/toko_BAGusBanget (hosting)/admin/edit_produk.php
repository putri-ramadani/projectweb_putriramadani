<?php
session_start();
require '../db.php';

if (!isset($_GET['id'])) {
    header("Location: produk.php");
    exit;
}

$id = $_GET['id'];
$produk = $koneksi->query("SELECT * FROM produk WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
$kategori = $koneksi->query("SELECT * FROM kategori")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $kategori_id = $_POST['kategori_id'];

    if ($_FILES['gambar']['name']) {
        $nama_file = $_FILES['gambar']['name'];
        $tmp_file = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp_file, "../img/" . $nama_file);
    } else {
        $nama_file = $produk['gambar'];
    }

    $stmt = $koneksi->prepare("UPDATE produk SET nama_produk=?, harga=?, gambar=?, kategori_id=? WHERE id=?");
    $stmt->execute([$nama, $harga, $nama_file, $kategori_id, $id]);

    header("Location: produk.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link rel="stylesheet" href="../css/style.css?v=<?= time() ?>">
</head>
<body class="admin-body">
    <div class="admin-container">
        <h2 style="text-align:center;">Edit Produk</h2>
        <form method="POST" enctype="multipart/form-data" class="form-admin">
            <input type="text" name="nama" class="input-box" value="<?= $produk['nama_produk'] ?>" required>

            <input type="number" name="harga" class="input-box" value="<?= $produk['harga'] ?>" required>

            <select name="kategori_id" class="input-box" required>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id'] ?>" <?= $k['id'] == $produk['kategori_id'] ? 'selected' : '' ?>>
                        <?= $k['nama'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="file" name="gambar" class="input-box">

            <button type="submit" name="update" class="btn">Update</button>
        </form>
    </div>
</body>
</html>
<?php
session_start();
require '../db.php';

if (!isset($_GET['id'])) {
    header("Location: produk.php");
    exit;
}

$id = $_GET['id'];
$produk = $koneksi->query("SELECT * FROM produk WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
$kategori = $koneksi->query("SELECT * FROM kategori")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $kategori_id = $_POST['kategori_id'];

    if ($_FILES['gambar']['name']) {
        $nama_file = $_FILES['gambar']['name'];
        $tmp_file = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp_file, "../img/" . $nama_file);
    } else {
        $nama_file = $produk['gambar'];
    }

    $stmt = $koneksi->prepare("UPDATE produk SET nama_produk=?, harga=?, gambar=?, kategori_id=? WHERE id=?");
    $stmt->execute([$nama, $harga, $nama_file, $kategori_id, $id]);

    header("Location: produk.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link rel="stylesheet" href="../css/style.css?v=<?= time() ?>">
</head>
<body class="admin-body">
    <div class="admin-container">
        <h2 style="text-align:center;">Edit Produk</h2>
        <form method="POST" enctype="multipart/form-data" class="form-admin">
            <input type="text" name="nama" class="input-box" value="<?= $produk['nama_produk'] ?>" required>

            <input type="number" name="harga" class="input-box" value="<?= $produk['harga'] ?>" required>

            <select name="kategori_id" class="input-box" required>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id'] ?>" <?= $k['id'] == $produk['kategori_id'] ? 'selected' : '' ?>>
                        <?= $k['nama'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="file" name="gambar" class="input-box">

            <button type="submit" name="update" class="btn">Update</button>
        </form>
    </div>
</body>
</html>
