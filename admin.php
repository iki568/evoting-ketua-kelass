<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit;
}

$candidates = $conn->query("SELECT * FROM candidates");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Hasil Voting</title>
    <style>
        body { font-family: sans-serif; padding: 50px; background-color: #f4f4f9; }
        table { width: 50%; margin: 0 auto; border-collapse: collapse; background: white; }
        th, td { border: 1px solid #333; padding: 15px; text-align: center; }
        th { background-color: #333; color: white; }
        .header { text-align: center; margin-bottom: 30px; }
        .logout { display: block; text-align: center; margin-top: 20px; font-weight: bold; color: red; text-decoration: none; }
    </style>
</head>
<body>
    <div class="header">
        <h2>📊 Hasil E-Voting Sementara</h2>
        <p>Halo, Admin. Berikut adalah perolehan suara saat ini.</p>
    </div>

    <table>
        <tr>
            <th>Nama Kandidat</th>
            <th>Jumlah Suara</th>
        </tr>
        <?php while($row = $candidates->fetch_assoc()): ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><h2><?= $row['votes'] ?></h2></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <a href="logout.php" class="logout">Logout</a>
</body>
</html>