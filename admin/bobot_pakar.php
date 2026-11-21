<?php
session_start(); require_once '../koneksi.php'; if (!isset($_SESSION['admin'])) { header('Location: login.php'); exit(); }
if (isset($_POST['simpan'])) { $id_gejala=(int)$_POST['id_gejala']; $id_penyakit=(int)$_POST['id_penyakit']; $bobot=(float)$_POST['bobot']; mysqli_query($koneksi,"INSERT INTO bobot_pakar (id_gejala,id_penyakit,bobot) VALUES('$id_gejala','$id_penyakit','$bobot')"); header('Location: bobot_pakar.php'); exit(); }
if (isset($_GET['hapus'])) { $id=(int)$_GET['hapus']; mysqli_query($koneksi,"DELETE FROM bobot_pakar WHERE id_bobot='$id'"); header('Location: bobot_pakar.php'); exit(); }
require_once 'layout.php'; admin_header('Bobot Pakar'); $gejala=mysqli_query($koneksi,'SELECT * FROM gejala ORDER BY kode_gejala'); $penyakit=mysqli_query($koneksi,'SELECT * FROM penyakit ORDER BY kode_penyakit'); $query=mysqli_query($koneksi,'SELECT bp.*,g.kode_gejala,g.nama_gejala,p.kode_penyakit,p.nama_penyakit FROM bobot_pakar bp JOIN gejala g ON bp.id_gejala=g.id_gejala JOIN penyakit p ON bp.id_penyakit=p.id_penyakit ORDER BY p.kode_penyakit,g.kode_gejala');
?>
<main class="container">
    <div class="page-heading">
        <div>
            <h1>Bobot Pakar</h1>
            <p class="subtitle">Hubungkan gejala dan penyakit dengan nilai keyakinan dari pakar.</p>
        </div>
    </div>
    <div class="grid">
        <section class="card">
            <h2>Tambah Aturan</h2>
            <form method="post">
                <label for="id_gejala">Gejala</label>
                <select id="id_gejala" name="id_gejala"><?php while($g=mysqli_fetch_assoc($gejala)): ?>
                    <option value="<?= $g['id_gejala'] ?>"><?= htmlspecialchars($g['kode_gejala'].' — '.$g['nama_gejala']) ?></option><?php endwhile; ?>
                </select>
                <label for="id_penyakit">Penyakit</label>
                <select id="id_penyakit" name="id_penyakit"><?php while($p=mysqli_fetch_assoc($penyakit)): ?>
                    <option value="<?= $p['id_penyakit'] ?>"><?= htmlspecialchars($p['kode_penyakit'].' — '.$p['nama_penyakit']) ?></option><?php endwhile; ?>
                </select>
                <label for="bobot">Bobot Pakar</label>
                <input id="bobot" type="number" name="bobot" min="0" max="1" step="0.1" placeholder="0.0 - 1.0" required>
                <button class="btn full" name="simpan">Simpan Aturan</button>
            </form>
        </section>
        <section class="card">
            <h2>Daftar Aturan Pakar</h2>
            <div class="table-wrap">
                <table>
                    <thead><tr>
                        <th>No</th>
                        <th>Gejala</th>
                        <th>Penyakit</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody><?php $no=1; while($data=mysqli_fetch_assoc($query)): ?>
                    <tr><td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($data['kode_gejala'].' — '.$data['nama_gejala']) ?></td>
                    <td><?= htmlspecialchars($data['kode_penyakit'].' — '.$data['nama_penyakit']) ?></td>
                    <td><?= htmlspecialchars($data['bobot']) ?></td>
                    <td><a class="action-delete" href="bobot_pakar.php?hapus=<?= $data['id_bobot'] ?>" onclick="return confirm('Hapus aturan ini?')">Hapus</a>
                </td>
            </tr><?php endwhile; ?>
        </tbody>
    </table>
</div>
</section>
</div>
</main>
<?php admin_footer(); ?>
