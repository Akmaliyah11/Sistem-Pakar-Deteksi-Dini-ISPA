<?php
session_start(); require_once '../koneksi.php'; if (!isset($_SESSION['admin'])) { header('Location: login.php'); exit(); }
if (isset($_POST['simpan'])) { $kode=mysqli_real_escape_string($koneksi,$_POST['kode_penyakit']); $nama=mysqli_real_escape_string($koneksi,$_POST['nama_penyakit']); mysqli_query($koneksi,"INSERT INTO penyakit (kode_penyakit,nama_penyakit) VALUES('$kode','$nama')"); header('Location: penyakit.php'); exit(); }
if (isset($_GET['hapus'])) { $id=(int)$_GET['hapus']; mysqli_query($koneksi,"DELETE FROM penyakit WHERE id_penyakit='$id'"); header('Location: penyakit.php'); exit(); }
require_once 'layout.php'; admin_header('Data Penyakit'); $query=mysqli_query($koneksi,'SELECT * FROM penyakit ORDER BY id_penyakit ASC');
?>
<main class="container">
    <div class="page-heading"><div>
        <h1>Data Penyakit</h1>
        <p class="subtitle">Kelola daftar penyakit yang dapat dianalisis sistem.</p>
    </div>
</div>
<div class="grid">
    <section class="card">
        <h2>Tambah Penyakit</h2>
        <form method="post">
            <label for="kode_penyakit">Kode Penyakit</label>
            <input id="kode_penyakit" name="kode_penyakit" placeholder="Contoh: P005" required>
            <label for="nama_penyakit">Nama Penyakit</label>
            <input id="nama_penyakit" name="nama_penyakit" placeholder="Masukkan nama penyakit" required>
            <button class="btn full" name="simpan">Simpan Penyakit</button>
        </form>
    </section>
    <section class="card">
        <h2>Daftar Penyakit</h2>
        <div class="table-wrap">
            <table><thead><tr><th>No</th><th>Kode</th><th>Nama Penyakit</th><th>Aksi</th></tr></thead>
            <tbody><?php $no=1; while($data=mysqli_fetch_assoc($query)): ?><tr><td><?= $no++ ?></td><td><?= htmlspecialchars($data['kode_penyakit']) ?></td><td><?= htmlspecialchars($data['nama_penyakit']) ?></td><td><a class="action-delete" href="penyakit.php?hapus=<?= $data['id_penyakit'] ?>" onclick="return confirm('Hapus penyakit ini?')">Hapus</a></td></tr><?php endwhile; ?>
            </tbody>
            </table>
            </div>
        </section>
    </div>
</main>
 <?php admin_footer(); ?>
