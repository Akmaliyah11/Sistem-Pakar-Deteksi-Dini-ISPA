<?php
session_start();
if (!isset($_SESSION['admin'])) { header('Location: login.php'); exit(); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') { session_destroy(); header('Location: login.php'); exit(); }
require_once 'layout.php'; admin_header('Keluar');
?>
<main class="container">
    <section class="card logout-card">
        <h1>Keluar dari Admin?</h1>
        <p>Anda akan keluar dari sesi pengelolaan sistem pakar.</p>
        <div class="logout-actions">
            <a class="btn btn-secondary" href="admin.php">Batal</a>
            <form method="post">
                <button class="btn" type="submit">Ya, Keluar</button>
            </form>
        </div>
    </section>
</main>
<?php admin_footer(); ?>
