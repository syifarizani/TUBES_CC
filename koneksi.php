<?php
$host     = "dbtubescc.cony8myouvm4.us-east-1.rds.amazonaws.com";
$user     = "admin";
$password = "kelompok4"; 
$database = "db_cloud"; 

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>