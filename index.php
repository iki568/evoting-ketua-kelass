<?php
session_start();
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') header("Location: admin.php");
    else header("Location: voting.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-Voting Ketua Kelas</title>
    <style>
        body { background-color: #5abcb9; font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background-color: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); text-align: center; width: 300px; border: 2px solid #333; }
        .login-box h2 { margin-bottom: 5px; }
        .login-box p { font-size: 14px; margin-bottom: 20px; }
        .input-group { text-align: left; margin-bottom: 15px; }
        .input-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .input-group input { width: 100%; padding: 8px; border: 2px solid #333; border-radius: 4px; box-sizing: border-box; }
        .btn-login { width: 100%; padding: 10px; background-color: #1e73be; color: white; border: 2px solid #333; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .btn-login:hover { background-color: #155a96; }
        .error { color: red; font-size: 14px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>📋 E-Voting Ketua Kelas</h2>
        <p>Silahkan login untuk memberikan suara anda</p>
        
        <?php if(isset($_GET['error'])) echo "<div class='error'>Username atau password salah!</div>"; ?>
        
        <form action="proses_login.php" method="POST">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn-login">Masuk / Pilih Sekarang</button>
        </form>
    </div>
</body>
</html>