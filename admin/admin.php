<?php
session_start(); require_once '../koneksi.php';
if (!isset($_SESSION['admin'])) { header('Location: login.php'); exit(); }
require_once 'layout.php';
$total_gejala = mysqli_fetch_assoc(mysqli_query($koneksi, 'SELECT COUNT(*) total FROM gejala'))['total'];
$total_penyakit = mysqli_fetch_assoc(mysqli_query($koneksi, 'SELECT COUNT(*) total FROM penyakit'))['total'];
$total_bobot_pakar = mysqli_fetch_assoc(mysqli_query($koneksi, 'SELECT COUNT(*) total FROM bobot_pakar'))['total'];
$total_bobot_user = mysqli_fetch_assoc(mysqli_query($koneksi, 'SELECT COUNT(*) total FROM bobot_user'))['total'];
admin_header('Dashboard Admin');
?>
<main class="container">
    <div class="page-heading">
        <div>
            <h1>Dashboard Admin</h1>
            <p class="subtitle">Kelola basis pengetahuan sistem deteksi penyakit.</p>
        </div>
    </div>
    <section class="stats">
        <div class="stat">
            <span>Gejala</span>
            <strong><?= $total_gejala ?></strong>
        </div>
        <div class="stat">
            <span>Penyakit</span>
            <strong><?= $total_penyakit ?></strong>
        </div>
        <div class="stat">
            <span>Aturan Pakar</span>
            <strong><?= $total_bobot_pakar ?></strong>
        </div>
        <div class="stat">
            <span>Skala Keyakinan</span>
            <strong><?= $total_bobot_user ?></strong>
        </div>
    </section>
    <section class="card" style="margin-top:22px">
        <h2>Mulai Pengelolaan</h2>
        <p class="subtitle">Gunakan navigasi di atas untuk menambah atau menghapus data gejala, penyakit, dan bobot pada sistem.</p>
    </section>
</main>
<?php admin_footer(); ?>
