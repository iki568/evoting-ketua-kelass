<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['has_voted'] = $row['has_voted'];

    if ($row['role'] == 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: voting.php");
    }
} else {
    header("Location: index.php?error=1");
}
?>