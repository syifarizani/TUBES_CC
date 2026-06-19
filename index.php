<?php
session_start();

// Mengambil IP internal dari Web Server EC2 untuk mendeteksi identitas server
$internal_ip = $_SERVER['SERVER_ADDR']; 

$is_server_1 = (strpos($internal_ip, '25.244') !== false); 

// Pengkondisian warna dan kode identitas sesuai instance untuk membuktikan Load Balancer bekerja [cite: 27, 28]
$bg_color   = $is_server_1 ? "#FFE5EC" : "#E0F2FE"; // Pink Soft vs Blue Soft
$text_color = $is_server_1 ? "#9B2C2C" : "#0369A1";
$server_id  = $is_server_1 ? "1" : "2"; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - Kelompok 4</title>
    <style>
        body { 
            background-color: <?php echo $bg_color; ?>; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        }
        .container { 
            text-align: center; 
            background: white; 
            padding: 50px; 
            border-radius: 20px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.08); 
            max-width: 450px;
            width: 100%;
        }
        h1 { color: <?php echo $text_color; ?>; margin-bottom: 10px; font-size: 28px; }
        p { color: #555; font-size: 16px; }
        .badge { 
            display: inline-block;
            background-color: <?php echo $text_color; ?>; 
            color: white; 
            padding: 8px 20px; 
            border-radius: 30px; 
            font-weight: bold; 
            margin-top: 15px;
        }
        .btn { 
            display: inline-block; 
            margin-top: 30px; 
            padding: 12px 30px; 
            background-color: <?php echo $text_color; ?>; 
            color: white; 
            text-decoration: none; 
            border-radius: 8px; 
            font-weight: bold; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tugas Besar Komputasi Awan</h1>
        <p>Kelompok 4</p>
        
        <div>
            <span class="badge">WEB SERVER INSTANCE: <?php echo $server_id; ?></span>
        </div>
        
        <a href="login.php" class="btn">Masuk ke Sistem Login</a>
    </div>
</body>
</html>