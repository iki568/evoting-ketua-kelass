<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'siswa') {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$candidate_id = $_GET['id'];

// Pastikan user belum voting
$cek = $conn->query("SELECT has_voted FROM users WHERE id=$user_id")->fetch_assoc();
if ($cek['has_voted'] == 0) {
    // Tambah suara kandidat
    $conn->query("UPDATE candidates SET votes = votes + 1 WHERE id=$candidate_id");
    // Tandai user sudah voting
    $conn->query("UPDATE users SET has_voted = 1 WHERE id=$user_id");
}

header("Location: voting.php");
?>