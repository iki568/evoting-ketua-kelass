<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'siswa') {
    header("Location: index.php");
    exit;
}

// Cek apakah siswa sudah voting (update data terbaru dari DB)
$user_id = $_SESSION['user_id'];
$cek_vote = $conn->query("SELECT has_voted FROM users WHERE id=$user_id")->fetch_assoc();

if ($cek_vote['has_voted'] == 1) {
    echo "<h2 style='text-align:center; margin-top:50px;'>Anda sudah melakukan voting. Terima kasih!</h2>";
    echo "<div style='text-align:center;'><a href='logout.php'>Logout</a></div>";
    exit;
}

$candidates = $conn->query("SELECT * FROM candidates");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Voting</title>
    <style>
        body { background-color: #dcedc1; font-family: sans-serif; text-align: center; padding: 50px; border: 2px solid #333; margin: 20px; }
        h1 { margin-bottom: 5px; }
        p { margin-bottom: 40px; font-size: 18px; }
        .kandidat-container { display: flex; justify-content: center; gap: 50px; margin-bottom: 50px; }
        .kandidat-box { background-color: white; border: 2px solid #333; padding: 30px; width: 150px; text-align: center; }
        .kandidat-box h3 { margin-top: 0; }
        .btn-vote { background-color: #8bc34a; border: 2px solid #333; padding: 10px 20px; font-weight: bold; cursor: pointer; color: black; text-decoration: none; display: inline-block; }
        .btn-vote:hover { background-color: #7cb342; }
        .logout { font-size: 20px; font-weight: bold; color: black; text-decoration: none; border-bottom: 2px solid black; }
    </style>
</head>
<body>
    <h1>Selamat Datang, <?= $_SESSION['username'] ?></h1>
    <p>Silahkan memilih</p>

    <div class="kandidat-container">
        <?php while($row = $candidates->fetch_assoc()): ?>
        <div class="kandidat-box">
            <h3><?= $row['name'] ?></h3>
            <a href="proses_vote.php?id=<?= $row['id'] ?>" class="btn-vote" onclick="return confirm('Yakin memilih <?= $row['name'] ?>?')">VOTE</a>
        </div>
        <?php endwhile; ?>
    </div>

    <a href="logout.php" class="logout">Logout</a>
</body>
</html>