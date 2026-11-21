<?php
session_start();
require_once __DIR__ . '/../koneksi.php';

$errors = [];
$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mulai_konsultasi'])) {
    $nama = trim($_POST['nama'] ?? '');
    $usia = filter_input(INPUT_POST, 'usia', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 130]]);
    $jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
    $telepon = trim($_POST['telepon'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');

    if ($nama === '') $errors[] = 'Nama lengkap wajib diisi.';
    if ($usia === false || $usia === null) $errors[] = 'Usia harus antara 1 sampai 130 tahun.';
    if (!in_array($jenis_kelamin, ['L', 'P'], true)) $errors[] = 'Jenis kelamin wajib dipilih.';
    if ($telepon === '') $errors[] = 'Nomor telepon wajib diisi.';
    if ($alamat === '') $errors[] = 'Alamat wajib diisi.';

    if (!$errors) {
        $stmt = mysqli_prepare($koneksi, 'INSERT INTO konsultasi (nama, usia, jenis_kelamin, nomor_telepon, alamat) VALUES (?, ?, ?, ?, ?)');
        mysqli_stmt_bind_param($stmt, 'sisss', $nama, $usia, $jenis_kelamin, $telepon, $alamat);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['id_konsultasi'] = mysqli_insert_id($koneksi);
            unset($_SESSION['hasil_diagnosa'], $_SESSION['gejala_dipilih']);
            $success = true;
        } else {
            $errors[] = 'Data pribadi gagal disimpan. Silakan coba lagi.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Deteksi Dini Pernapasan Akut</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
body { 
    background: linear-gradient(135deg, #f0fdf4 0%, #e6f4f1 100%); 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    color: #1e293b;
    overflow-x: hidden;
}

.page-container {
    background-color: #ffffff;
    padding: 24px;
    width: 100%;
    margin: 0px auto !important;
    margin-top: -30px !important;
    border-radius: 24px;
    box-shadow: 0 20px 40px rgba(4, 120, 87, 0.04);
    border: 1px solid #e2e8f0;
    box-sizing: border-box;
}

.content {
    padding-top: 18px;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    margin-top: -30px;
    background: #ffffff;
    border-radius: 24px;
    box-shadow: 0 20px 40px rgba(4, 120, 87, 0.05);
    border: 1px solid #e2e8f0;
    display: flex;
    overflow: hidden;
}

/* Bagian Formulir Kiri */
.form-section {
    flex: 0 0 380px;
    padding: 40px;
    border-radius: 24px;
    background: linear-gradient(135deg, #f0fdf4 0%, #e6f4f1 100%); 
    border-right: 1px solid #f1f5f9;
}

.form-section h2 {
    font-size: 22px;
    color: #0f766e;
    font-weight: 700;
    margin-top: 0;
    margin-bottom: 24px;
    position: relative;
}

.form-section h2::after {
    content: '';
    display: block;
    width: 40px;
    height: 4px;
    background: #10b981;
    border-radius: 2px;
    margin-top: 8px;
}

.input-group {
    margin-bottom: 20px;
}

.input-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #475569;
    margin-bottom: 6px;
}

.input-group input, 
.input-group select, 
.input-group textarea {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #cbd5e1;
    border-radius: 12px;
    font-size: 14px;
    background-color: #f8fafc;
    box-sizing: border-box;
    transition: all 0.2s ease;
}

.input-group input:focus, 
.input-group select:focus, 
.input-group textarea:focus {
    outline: none;
    border-color: #10b981;
    background-color: #ffffff;
    box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
}

.btn-submit {
    width: 100%;
    background: #0f766e;
    color: #fff;
    padding: 14px;
    border: none;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-submit:hover {
    background: #115e59;
    box-shadow: 0 4px 12px rgba(15, 118, 110, 0.2);
}

.form-error {
    background-color: #fef2f2;
    border-left: 4px solid #ef4444;
    color: #991b1b;
    padding: 12px;
    border-radius: 8px;
    font-size: 13px;
    margin-bottom: 20px;
}

.form-success {
    background-color: #ecfdf5;
    border-left: 4px solid #10b981;
    color: #065f46;
    padding: 12px;
    border-radius: 8px;
    font-size: 13px;
    margin-bottom: 20px;
}

/* Bagian Konten Kanan */
.main-content {
    flex: 1.2;
    padding: 40px;
    background: linear-gradient(to bottom right, #f8fafc, #f0fdfa);
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.main-content h1 {
    font-size: 32px;
    line-height: 1.3;
    color: #0f172a;
    margin-top: 0;
    margin-bottom: 14px;
    font-weight: 800;
}

.main-content h1 span {
    color: #0f766e;
}

.subtitle {
    color: #475569;
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 28px;
}

.btn-consult {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: #ffffff !important;
    padding: 16px 36px;
    border: none;
    border-radius: 16px;
    font-size: 16px;
    font-weight: 700;
    text-align: center;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: fit-content;
    box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
    transition: all 0.2s ease;
}

.btn-consult:hover { 
    transform: translateY(-2px); 
    box-shadow: 0 12px 30px rgba(16, 185, 129, 0.4); 
}

.btn-consult-disabled {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: #ffffff !important;
    padding: 16px 36px;
    border-radius: 16px;
    font-size: 16px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: fit-content;
    cursor: not-allowed;
}

/* Tiga Kotak Informasi */
.info-cards-container {
    margin-top: 32px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 16px;
}

.info-card {
    background: #ffffff;
    padding: 18px;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    transition: all 0.2s ease;
}

.info-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 20px rgba(15, 118, 110, 0.06);
    border-color: #99f6e4;
}

.info-card h3 {
    font-size: 14px;
    color: #0f766e;
    font-weight: 700;
    margin-top: 0;
    margin-bottom: 8px;
}

.info-card p {
    font-size: 12px;
    color: #64748b;
    line-height: 1.5;
    margin: 0;
}

/* Responsif Mobile */
@media (max-width: 900px) {
    .container {
        flex-direction: column;
    }
    .form-section {
        border-right: none;
        border-bottom: 1px solid #f1f5f9;
        padding: 30px 20px;
    }
    .main-content {
        padding: 30px 20px;
    }
    .main-content h1 {
        font-size: 26px;
    }
}
</style>
<body>

    <?php
    $page_title = "Beranda";
    echo '<div class="header-sticky">';
    @include __DIR__ . '/header.php';
    echo '</div>';
    ?>
    <div class="page-container">
    <main class="content">
    <div class="container">
        <!-- Bagian Formulir Kiri -->
        <section class="form-section">
            <h2>Informasi Pribadi</h2>
            <?php if ($errors): ?>
                <div class="form-error"><?= htmlspecialchars(implode(' ', $errors)) ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="form-success">Informasi pribadi berhasil disimpan. Silakan klik tombol Konsultasi untuk melanjutkan.</div>
            <?php endif; ?>
            
            <form method="post">
                <div class="input-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Masukkan nama lengkap" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>" required>
                </div>
                <div class="input-group">
                    <label>Usia</label>
                    <input type="number" name="usia" min="1" max="130" placeholder="Masukkan usia" value="<?= htmlspecialchars($_POST['usia'] ?? '') ?>" required>
                </div>
                <div class="input-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" required>
                        <option value="">Pilih</option>
                        <option value="L" <?= (($_POST['jenis_kelamin'] ?? '') === 'L') ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="P" <?= (($_POST['jenis_kelamin'] ?? '') === 'P') ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
                <div class="input-group">
                    <label>Nomor Telepon</label>
                    <input type="tel" name="telepon" placeholder="08xxx" value="<?= htmlspecialchars($_POST['telepon'] ?? '') ?>" required>
                </div>
                <div class="input-group">
                    <label>Alamat</label>
                    <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap" required><?= htmlspecialchars($_POST['alamat'] ?? '') ?></textarea>
                </div>
                <button type="submit" name="mulai_konsultasi" class="btn-submit">Submit</button>
            </form>
        </section>

        <!-- Bagian Konten Kanan -->
        <section class="main-content">
            <h1>Deteksi Dini <br>Bebas <span>Gangguan Pernapasan Akut</span></h1>
            <p class="subtitle">Jawab kuisioner gejala dengan teliti untuk mendapatkan analisis dini berdasarkan pola penalaran pakar medis.</p>
            
            <!-- Tombol Konsultasi Kontrol Tampilan -->
            <?php if ($success): ?>
                <a href="konsultasi.php" class="btn-consult">Mulai Konsultasi &rarr;</a>
            <?php else: ?>
                <div class="btn-consult-disabled">Konsultasi &rarr;</div>
                <small style="margin-top: 8px; color: #64748b;">*Isi dan simpan informasi pribadi di sebelah kiri terlebih dahulu.</small>
            <?php endif; ?>

            <!-- Tiga Kotak Informasi -->
            <div class="info-cards-container">
                <div class="info-card">
                    <h3>Apa itu ISPA?</h3>
                    <p>ISPA mencakup penyakit pernapasan dengan prevalensi tinggi seperti pneumonia, difteri, dan infeksi virus akut lainnya.</p>
                </div>
                <div class="info-card">
                    <h3>Metode Inferensi</h3>
                    <p>Menggunakan metode Forward Chaining dan Certainty Factor untuk mengukur tingkat kepastian klinis.</p>
                </div>
                <div class="info-card">
                    <h3>Tinjauan Pakar</h3>
                    <p>Aturan basis pengetahuan divalidasi berdasarkan rujukan medis untuk hasil skrining awal yang objektif.</p>
                </div>
            </div>
        </section>
    </div>
    </main>
</div>
</body>
</html>