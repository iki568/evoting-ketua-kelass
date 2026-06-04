<?php
$host = "localhost";
$user = "root"; // Sesuaikan jika ada perubahan user di database kamu
$pass = "";     // Sesuaikan jika ada password di database kamu
$db   = "db_evoting";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>