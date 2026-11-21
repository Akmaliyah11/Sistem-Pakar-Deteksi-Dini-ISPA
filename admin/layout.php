<?php
function admin_header(string $title): void {
    $current = basename($_SERVER['PHP_SELF']);
    $links = ['admin.php' => 'Dashboard', 'gejala.php' => 'Gejala', 'penyakit.php' => 'Penyakit', 'bobot_pakar.php' => 'Bobot Pakar', 'bobot_user.php' => 'Bobot User'];
    ?>
    <!DOCTYPE html>
    <html lang="id">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= htmlspecialchars($title) ?> | Expert ARI</title>
            <link rel="stylesheet" href="style.css"></head>
            <body>
    <header class="topbar">
            <a class="brand" href="admin.php" >
                <span class="brand-mark" >
                    <svg xmlns="http://w3.org" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-activity"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                </span>
                EXPERT ARI <small style="margin-left: 4px;">ADMIN</small>
            </a>
            <nav class="nav"><?php foreach ($links as $file => $label): ?>
                <a class="<?= $current === $file ? 'active' : '' ?>" href="<?= $file ?>"><?= $label ?></a>
                <?php endforeach; ?>
                <a class="logout" href="logout.php">Keluar</a>
            </nav>
    </header>
    <?php
}
function admin_footer(): void { echo '</body></html>'; }
