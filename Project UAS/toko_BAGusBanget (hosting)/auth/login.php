<?php
session_start();
require '../db.php';

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $koneksi->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (is_array($user) && trim($password) === trim($user['password'])) {
        $_SESSION['user'] = $user;
        if ($user['level'] == 'admin') {
            header("Location: ../admin/index.php");
        } else {
            header("Location: ../user/index.php");
        }
        exit;
    } else {
        $error = "Email atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - BAGus Banget</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="centered-body">
    <div class="form-box">
       <img src="../img/LOGO.png" 
       alt="Logo BAGus Banget" style="width:120px; margin-bottom: 10px;"> 
        <h2>Login</h2>
        <?php if (isset($error)) : ?>
            <div class="alert error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="Email" required class="input-box"><br>
            <input type="password" name="password" placeholder="Password" required class="input-box"><br>
            <button type="submit" name="login" class="btn">Login</button>
        </form>
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>
</body>
</html>
