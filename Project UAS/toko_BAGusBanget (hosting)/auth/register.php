<?php
require '../db.php';

if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $level = 'user';

    $stmt = $koneksi->prepare("INSERT INTO user (nama, email, password, level) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nama, $email, $password, $level]);

    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - BAGus Banget</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="centered-body">
    <div class="form-box">
        <h2>Register</h2>
        <form method="POST">
            <input type="text" name="nama" placeholder="Nama Lengkap" required class="input-box"><br>
            <input type="email" name="email" placeholder="Email" required class="input-box"><br>
            <input type="password" name="password" placeholder="Password" required class="input-box"><br>
            <button type="submit" name="register" class="btn">Daftar</button>
        </form>
        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
</body>
</html>
<?php
require '../db.php';

if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $level = 'user';

    $stmt = $koneksi->prepare("INSERT INTO user (nama, email, password, level) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nama, $email, $password, $level]);

    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - BAGus Banget</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="centered-body">
    <div class="form-box">
        <h2>Register</h2>
        <form method="POST">
            <input type="text" name="nama" placeholder="Nama Lengkap" required class="input-box"><br>
            <input type="email" name="email" placeholder="Email" required class="input-box"><br>
            <input type="password" name="password" placeholder="Password" required class="input-box"><br>
            <button type="submit" name="register" class="btn">Daftar</button>
        </form>
        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
</body>
</html>
