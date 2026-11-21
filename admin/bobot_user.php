<?php
session_start(); require_once '../koneksi.php'; if (!isset($_SESSION['admin'])) { header('Location: login.php'); exit(); }
if (isset($_POST['simpan'])) { $keterangan=mysqli_real_escape_string($koneksi,$_POST['keterangan']); $nilai=(float)$_POST['nilai']; mysqli_query($koneksi,"INSERT INTO bobot_user (keterangan,nilai) VALUES('$keterangan','$nilai')"); header('Location: bobot_user.php'); exit(); }
if (isset($_GET['hapus'])) { $id=(int)$_GET['hapus']; mysqli_query($koneksi,"DELETE FROM bobot_user WHERE id_bobot_user='$id'"); header('Location: bobot_user.php'); exit(); }
require_once 'layout.php'; admin_header('Bobot User'); $query=mysqli_query($koneksi,'SELECT * FROM bobot_user ORDER BY nilai ASC');
?>
<main class="container">
    <div class="page-heading">
        <div>
            <h1>Bobot Keyakinan User</h1>
            <p class="subtitle">Atur skala nilai Certainty Factor yang dapat dipilih pengguna.</p>
        </div>
    </div>
    <div class="grid">
        <section class="card">
            <h2>Tambah Skala Keyakinan</h2>
            <form method="post">
                <label for="keterangan">Keterangan</label>
                <input id="keterangan" name="keterangan" placeholder="Contoh: Sangat Yakin" required>
                <label for="nilai">Nilai CF</label>
                <input id="nilai" type="number" name="nilai" min="0" max="1" step="0.1" placeholder="0.0 - 1.0" required>
                <button class="btn full" name="simpan">Simpan Bobot</button>
            </form>
        </section>
        <section class="card">
            <h2>Daftar Skala</h2>
            <div class="table-wrap">
                <table>
                    <thead><tr>
                        <th>No</th>
                        <th>Keterangan</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody><?php $no=1; while($data=mysqli_fetch_assoc($query)): ?>
                    <tr><td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($data['keterangan']) ?></td>
                    <td><?= htmlspecialchars($data['nilai']) ?></td>
                    <td>
                        <a class="action-delete" href="bobot_user.php?hapus=<?= $data['id_bobot_user'] ?>" onclick="return confirm('Hapus bobot ini?')">Hapus</a>
                    </td>
                </tr><?php endwhile; ?>
            </tbody>
        </table>
    </div>
</section>
</div>
</main>
<?php admin_footer(); ?>
