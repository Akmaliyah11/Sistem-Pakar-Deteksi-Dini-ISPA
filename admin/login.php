<?php
session_start(); require_once '../koneksi.php'; $error = '';
if (isset($_POST['login'])) { 
    $username = mysqli_real_escape_string($koneksi, $_POST['username'] ?? ''); 
    $password = md5($_POST['password'] ?? ''); 
    $data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' AND password='$password'")); 
    if ($data) { 
        $_SESSION['admin'] = $data['id_admin']; 
        header('Location: admin.php'); 
        exit(); 
    } 
    $error = 'Username atau password tidak sesuai.'; 
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Expert ARI</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">
    <main class="login-card">
        <div class="brand-mark">
            <svg xmlns="http://w3.org" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-activity"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
        </div>
        <h1>Login Admin</h1>
        <p class="subtitle">Masuk untuk mengelola data sistem pakar.</p>
        
        <?php if ($error): ?>
            <div class="alert"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <form method="post">
            <label for="username">Username</label>
            <input id="username" type="text" name="username" required autofocus autocomplete="off">
            
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
            
            <button class="btn full" type="submit" name="login">
                Masuk ke Dashboard
            </button>
        </form>
        
        <p class="subtitle back-link" onclick="window.location.href='../user/beranda.php'" style="cursor: pointer; display: inline-flex; align-items: center; gap: 4px;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali ke beranda
        </p>

    </main>
</body>
</html>