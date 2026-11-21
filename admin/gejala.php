<?php
session_start(); require_once '../koneksi.php'; if (!isset($_SESSION['admin'])) { header('Location: login.php'); exit(); }
if (isset($_POST['simpan'])) { $kode=mysqli_real_escape_string($koneksi,$_POST['kode_gejala']); $nama=mysqli_real_escape_string($koneksi,$_POST['nama_gejala']); mysqli_query($koneksi,"INSERT INTO gejala (kode_gejala,nama_gejala) VALUES('$kode','$nama')"); header('Location: gejala.php'); exit(); }
if (isset($_GET['hapus'])) { $id=(int)$_GET['hapus']; mysqli_query($koneksi,"DELETE FROM gejala WHERE id_gejala='$id'"); header('Location: gejala.php'); exit(); }
require_once 'layout.php'; admin_header('Data Gejala'); $query=mysqli_query($koneksi,'SELECT * FROM gejala ORDER BY id_gejala ASC');
?>
<main class="container">
    <div class="page-heading"><div>
        <h1>Data Gejala</h1>
        <p class="subtitle">Tambahkan dan kelola gejala yang digunakan pada aturan diagnosis.</p>
    </div>
</div>
<div class="grid">
    <section class="card">
        <h2>Tambah Gejala</h2>
        <form method="post">
            <label for="kode_gejala">Kode Gejala</label>
            <input id="kode_gejala" name="kode_gejala" placeholder="Contoh: G0030" required>
            <label for="nama_gejala">Nama Gejala</label>
            <input id="nama_gejala" name="nama_gejala" placeholder="Masukkan nama gejala" required>
            <button class="btn full" name="simpan">Simpan Gejala</button>
        </form>
    </section>
    <section class="card">
        <h2>Daftar Gejala</h2>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>No</th><th>Kode</th><th>Nama Gejala</th><th>Aksi</th></tr></thead><tbody><?php $no=1; while($data=mysqli_fetch_assoc($query)): ?><tr><td><?= $no++ ?></td><td><?= htmlspecialchars($data['kode_gejala']) ?></td><td><?= htmlspecialchars($data['nama_gejala']) ?></td><td><a class="action-delete" href="gejala.php?hapus=<?= $data['id_gejala'] ?>" onclick="return confirm('Hapus gejala ini?')">Hapus</a></td></tr><?php endwhile; ?></tbody></table>
            </div>
        </section>
    </div>
 </main>
<?php admin_footer(); ?>
