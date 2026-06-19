<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

// Menggunakan gethostname agar akurat membaca nama instans AWS EC2 (mengandung 25-244)
$hostname = gethostname();
$is_server_1 = (strpos($hostname, '25-244') !== false);

$bg_color   = $is_server_1 ? "#FFE5EC" : "#E0F2FE"; // Pink Soft vs Biru Soft
$text_color = $is_server_1 ? "#9B2C2C" : "#0369A1";
$server_id  = $is_server_1 ? "1" : "2"; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Utama - Kelompok 4</title>
    <style>
        body { background-color: <?php echo $bg_color; ?>; font-family: 'Segoe UI', sans-serif; padding: 40px; margin: 0; }
        .header-menu { display: flex; justify-content: space-between; align-items: center; background: white; padding: 20px 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        h2 { color: <?php echo $text_color; ?>; margin: 0; }
        .server-indicator { font-size: 16px; font-weight: bold; background: <?php echo $text_color; ?>; color: white; padding: 10px 20px; border-radius: 8px; }
        .table-container { margin-top: 30px; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        h3 { margin-top: 0; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #eee; }
        th, td { padding: 14px; text-align: left; }
        th { background-color: <?php echo $text_color; ?>; color: white; }
        tr:nth-child(even) { background-color: #fcfcfc; }
        .btn-logout { display: inline-block; margin-top: 25px; background-color: #E53E3E; color: white; padding: 12px 25px; text-decoration: none; border-radius: 6px; font-weight: bold; }
    </style>
</head>
<body>

    <div class="header-menu">
        <h2>Menu Utama</h2>
        <div class="server-indicator">WEB INSTANCE CODE: <?php echo $server_id; ?></div>
    </div>

    <div class="table-container">
        <h3>Daftar Anggota Kelompok</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama Anggota</th>
                    <th>NIM</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menarik data langsung dari entry di AWS RDS
                $query = "SELECT * FROM anggota";
                $result = mysqli_query($conn, $query);
                
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nim']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2' style='text-align:center;'>Data tidak ditemukan di database.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <a href="logout.php" class="btn-logout">Log Out</a>
    </div>

</body>
</html>