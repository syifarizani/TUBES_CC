<?php
session_start();
include 'koneksi.php';

$internal_ip = $_SERVER['SERVER_ADDR'];
$is_server_1 = (strpos($internal_ip, '25.244') !== false);

$bg_color   = $is_server_1 ? "#FFE5EC" : "#E0F2FE";
$text_color = $is_server_1 ? "#9B2C2C" : "#0369A1";

$error = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Mencocokkan data login ke tabel users di AWS RDS [cite: 23]
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) === 1) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        header("Location: mainmenu.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem - Kelompok 4</title>
    <style>
        body { background-color: <?php echo $bg_color; ?>; font-family: 'Segoe UI', sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: white; padding: 40px; border-radius: 15px; box-shadow: 0 8px 20px rgba(0,0,0,0.06); width: 320px; }
        h2 { text-align: center; color: <?php echo $text_color; ?>; margin-bottom: 25px; }
        input[type="text"], input[type="password"] { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background-color: <?php echo $text_color; ?>; color: white; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; margin-top: 15px; }
        .error { color: #E53E3E; text-align: center; font-size: 14px; font-weight: bold; background: #FFF5F5; padding: 8px; border-radius: 5px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Sistem Login</h2>
        
        <?php if($error) : ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form action="" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Sign In</button>
        </form>
    </div>
</body>
</html>