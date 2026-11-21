<?php
session_start();
require_once __DIR__ . '/../koneksi.php';

if (empty($_SESSION['id_konsultasi']) || empty($_SESSION['hasil_diagnosa']) || !is_array($_SESSION['hasil_diagnosa'])) {
    header('Location: konsultasi.php');
    exit();
}

$id_konsultasi = (int) $_SESSION['id_konsultasi'];
$pasien_query = mysqli_query($koneksi, "SELECT nama, usia, jenis_kelamin, nomor_telepon, alamat FROM konsultasi WHERE id_konsultasi = $id_konsultasi");
$pasien = mysqli_fetch_assoc($pasien_query);
$hasil = $_SESSION['hasil_diagnosa'];
$gejala_dipilih = $_SESSION['gejala_dipilih'] ?? [];

if (!$pasien || empty($hasil)) {
    header('Location: konsultasi.php');
    exit();
}

usort($hasil, fn($a, $b) => $b['cf'] <=> $a['cf']);
$tertinggi = $hasil[0];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Deteksi - Expert ARI</title>
    <style>
        body { 
            background: linear-gradient(135deg, #f0fdf4 0%, #e6f4f1 100%); 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: #1e293b;
            overflow-x: hidden;
        }
        * { 
            box-sizing: border-box; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        }

        .page-container {
            background-color: #ffffff;
            padding: 24px;
            width: 100%;
            margin: 0px auto;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(4, 120, 87, 0.04);
            border: 1px solid #e2e8f0;
            box-sizing: border-box;
        }

        .content { 
            padding-top: 10px; 
        }

        .container { 
            width: 100%; 
            margin: 10px auto 30px; 
        }

        .main-title { 
            margin: 0 0 6px; 
            font-size: 28px; 
            color: #065f46; 
            font-weight: 800; 
            letter-spacing: -0.5px;
        }
        
        .sub-title { 
            margin: 0 0 28px; 
            color: #4b5563; 
            font-size: 14px; 
            line-height: 1.5; 
        }

        .patient-info { 
            margin-bottom: 28px; 
            border-left: 4px solid #10b981; 
            background: #f9fafb; 
            padding: 20px;
            border-radius: 0 16px 16px 0;
            border-top: 1px solid #e5e7eb;
            border-right: 1px solid #e5e7eb;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 4px 15px rgba(6, 95, 70, 0.02);
        }
        .patient-text { 
            margin: 0 0 8px; 
            font-size: 16px; 
            font-weight: 700; 
            color: #111827; 
        }
        .patient-detail { 
            margin: 6px 0; 
            font-size: 13px; 
            color: #4b5563; 
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }
        .warning-box {
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px dashed #e5e7eb;
            display: flex;
            gap: 8px;
            align-items: flex-start;
        }
        .warning-text { 
            margin: 0; 
            color: #9a3412; 
            font-size: 12px; 
            line-height: 1.6; 
            font-style: italic;
        }

        .section-heading { 
            margin: 28px 0 16px; 
            font-size: 16px; 
            color: #111827; 
            font-weight: 700; 
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .section-heading svg {
            color: #0d9488;
            flex-shrink: 0;
        }

        .symptoms-section { 
            margin-bottom: 28px; 
            padding: 20px; 
            border: 1px solid #e5e7eb; 
            border-radius: 16px; 
            background: #ffffff; 
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.01);
        }
        .symptoms-list { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); 
            gap: 12px; 
            margin: 0; 
            padding: 0; 
            list-style: none; 
        }
        .symptoms-list li { 
            padding: 14px; 
            border-radius: 12px; 
            background: #fdfdfd; 
            border: 1px solid #e5e7eb; 
            font-size: 13px; 
            color: #374151; 
            line-height: 1.5; 
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.01);
        }
        .symptoms-list b { 
            color: #0d9488; 
            background: #ccfbf1;
            padding: 2px 6px;
            border-radius: 6px;
            font-size: 11px;
            margin-right: 4px;
        }
        .symptom-confidence { 
            display: block; 
            margin-top: 6px; 
            color: #6b7280; 
            font-size: 12px;
            font-style: italic; 
        }

        .result-box { 
            margin: 32px 0; 
            padding: 32px 24px; 
            text-align: center; 
            border-radius: 20px; 
            background: linear-gradient(145deg, #ffffff, #f0fdf4); 
            border: 1px solid #a7f3d0; 
            box-shadow: 0 10px 25px rgba(6, 95, 70, 0.04);
            position: relative;
            overflow: hidden;
        }
        .result-box::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, #0d9488, #10b981);
        }
        .result-statement { 
            margin: 0 0 12px; 
            font-size: 14px; 
            color: #4b5563; 
        }
        .result-disease { 
            margin: 0; 
            font-size: 32px; 
            color: #065f46; 
            font-weight: 800; 
            letter-spacing: -0.02em; 
        }
        .result-accuracy { 
            margin: 10px 0 24px; 
            font-size: 16px; 
            font-weight: 700; 
            color: #0d9488; 
            background: #e6fffa;
            display: inline-block;
            padding: 4px 14px;
            border-radius: 99px;
            border: 1px solid #b2f5ea;
        }
        .btn-retry { 
            display: inline-flex; 
            padding: 12px 24px; 
            border: none; 
            border-radius: 12px; 
            background: linear-gradient(135deg, #0d9488, #10b981); 
            color: #ffffff; 
            text-decoration: none; 
            font-size: 13px; 
            font-weight: 700; 
            align-items: center; 
            gap: 8px; 
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.2);
            transition: all .2s ease; 
        }
        .btn-retry:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 6px 18px rgba(13, 148, 136, 0.3);
            filter: brightness(1.05);
        }

        .bar-group { 
            display: grid; 
            gap: 14px; 
            background: #ffffff;
            padding: 20px;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
        }
        .bar-row {
            background: #fbfbfb;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #f3f4f6;
        }
        .bar-label { 
            display: flex; 
            justify-content: space-between; 
            gap: 16px; 
            margin-bottom: 8px; 
            font-size: 13px; 
            font-weight: 700; 
            color: #374151; 
        }
        .bar-label span:last-child { 
            color: #0d9488; 
            white-space: nowrap; 
        }
        .bar-track { 
            height: 10px; 
            overflow: hidden; 
            border-radius: 99px; 
            background: #e5e7eb; 
        }
        .bar-fill { 
            height: 100%; 
            border-radius: inherit; 
            background: linear-gradient(90deg, #0d9488, #10b981); 
        }

        .detail-section { 
            margin-top: 32px; 
        }
        .table-wrap { 
            overflow-x: auto; 
            border: 1px solid #e5e7eb; 
            border-radius: 16px; 
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.01);
        }
        .results-table { 
            width: 100%; 
            min-width: 760px; 
            border-collapse: collapse; 
            font-size: 13px; 
        }
        .results-table th { 
            padding: 14px; 
            background: #0f172a; 
            color: #fff; 
            text-align: left; 
            white-space: nowrap; 
            font-weight: 600;
        }
        .results-table td { 
            padding: 14px; 
            vertical-align: middle; 
            border-top: 1px solid #e5e7eb; 
            color: #4b5563; 
        }
        .results-table tbody tr:nth-child(even) { 
            background: #f9fafb; 
        }
        .results-table tbody tr:hover {
            background: #f0fdf4;
        }
        .results-table td:nth-child(1), 
        .results-table td:nth-child(2), 
        .results-table td:nth-child(3),
        .results-table td:nth-child(5), 
        .results-table td:nth-child(6) { 
            white-space: nowrap; 
        }
        .results-table td:nth-child(6) {
            font-weight: 700;
            color: #0d9488;
        }
        .rule-path { 
            min-width: 245px; 
            line-height: 1.5; 
            font-family: monospace;
            background: #f4f4f5;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
        }

        .solutions-section { 
            margin-top: 32px;
            padding: 24px; 
            border: 1px solid #e5e7eb;
            background: #ffffff;
            border-radius: 16px;
        }
        .solutions-heading { 
            margin: 0 0 16px; 
            font-size: 15px; 
            font-weight: 700; 
            color: #111827; 
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .solutions-heading svg {
            color: #10b981;
        }
        .solutions-list { 
            margin: 0; 
            padding-left: 0; 
            color: #4b5563; 
            font-size: 13px; 
            line-height: 1.7; 
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .solutions-list li { 
            position: relative;
            padding-left: 24px;
        }
        .solutions-list li::before {
            content: "✓";
            position: absolute;
            left: 0;
            top: 0;
            color: #10b981;
            font-weight: 800;
            font-size: 14px;
        }

        @media (max-width: 900px) {
            .results-table { min-width: 680px; }
        }
        @media (max-width: 600px) {
            .page-container { padding: 16px; }
            .main-title { font-size: 24px; }
            .result-disease { font-size: 24px; }
            .patient-detail { flex-direction: column; gap: 4px; }
        }
    </style>
</head>
<body>
<?php $page_title = 'HASIL'; include __DIR__ . '/header.php'; ?>
<div class="page-container">
    <main class="content">
        <div class="container">
            <h1 class="main-title">Hasil Deteksi</h1>
            <p class="sub-title">Analisis komprehensif berdasarkan gejala yang Anda laporkan.</p>

            <!-- Card Informasi Pasien -->
            <section class="patient-info">
                <p class="patient-text">Data Pasien: <?= htmlspecialchars($pasien['nama']) ?> (<?= (int) $pasien['usia'] ?> Tahun)</p>
                <div class="patient-detail">
                    <span><b>Jenis Kelamin:</b> <?= $pasien['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?></span>
                    <span>•</span>
                    <span><b>No. Telepon:</b> <?= htmlspecialchars($pasien['nomor_telepon']) ?></span>
                </div>
                <div class="patient-detail">
                    <span><b>Alamat:</b> <?= htmlspecialchars($pasien['alamat']) ?></span>
                </div>
                <div class="warning-box">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#b45309" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0; margin-top:2px;">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <p class="warning-text">Peringatan: Hasil sistem ini merupakan skrining awal (deteksi dini) menggunakan kecerdasan buatan berbasis aturan keputusan pakar, dan tidak menggantikan diagnosis medis klinis dari dokter atau ahli kesehatan profesional.</p>
                </div>
            </section>

            <!-- Card Daftar Gejala Terpilih -->
            <!-- <?php if ($gejala_dipilih): ?>
                <h2 class="section-heading">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    Gejala Klinis yang Dialami
                </h2>
                <section class="symptoms-section">
                    <ul class="symptoms-list">
                        <?php foreach ($gejala_dipilih as $gejala): ?>
                            <li>
                                <b><?= htmlspecialchars($gejala['kode']) ?></b> <?= htmlspecialchars($gejala['nama']) ?>
                                <span class="symptom-confidence">Kondisi: <?= htmlspecialchars($gejala['keyakinan']) ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </section>
            <?php endif; ?> -->

            <!-- Box Hasil Utama -->
            <section class="result-box">
                <p class="result-statement">Berdasarkan hasil kalkulasi sistem pakar, indikasi tertinggi adalah:</p>
                <h3 class="result-disease"><?= htmlspecialchars($tertinggi['penyakit']) ?></h3>
                <div class="result-accuracy">Tingkat Keyakinan (CF): <?= number_format($tertinggi['cf'] * 100, 2) ?>%</div>
                <div>
                    <a class="btn-retry" href="beranda.php">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 4px;"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                        Mulai Deteksi Baru
                    </a>
                </div>
            </section>

            <!-- Progress Bar Diagnosa -->
            <section>
                <h2 class="section-heading">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                    Tingkat Keyakinan Seluruh Komparasi Diagnosis
                </h2>
                <div class="bar-group">
                    <?php foreach ($hasil as $item):
                        $persentase = max(0, min(100, $item['cf'] * 100)); ?>
                        <div class="bar-row">
                            <div class="bar-label">
                                <span><?= htmlspecialchars($item['penyakit']) ?></span>
                                <span><?= number_format($persentase, 2) ?>%</span>
                            </div>
                            <div class="bar-track"><div class="bar-fill" style="width: <?= $persentase ?>%"></div></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- Tabel Rincian Perhitungan -->
            <!-- <section class="detail-section">
                <h2 class="section-heading">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="3" x2="9" y2="21"></line><line x1="15" y1="3" x2="15" y2="21"></line><line x1="3" y1="9" x2="21" y2="9"></line><line x1="3" y1="15" x2="21" y2="15"></line></svg>
                    Rincian Perhitungan Sistem Pakar (Certainty Factor)
                </h2>
                <div class="table-wrap">
                    <table class="results-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Penyakit</th>
                                <th>Aturan Forward Chaining</th>
                                <th>Nilai CF</th>
                                <th>Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($hasil as $index => $item): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><span style="font-weight:600; color:#0f172a;"><?= htmlspecialchars($item['kode']) ?></span></td>
                                    <td style="font-weight:600; color:#065f46;"><?= htmlspecialchars($item['penyakit']) ?></td>
                                    <td><span class="rule-path"><?= htmlspecialchars($item['rule_path']) ?></span></td>
                                    <td><?= number_format($item['cf'], 4) ?></td>
                                    <td><?= number_format($item['cf'] * 100, 2) ?>%</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section> -->

            <!-- Solusi / Tindakan Lanjutan -->
            <section class="solutions-section">
                <h4 class="solutions-heading">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    Solusi &amp; Tindakan Lanjutan Edukatif
                </h4>
                <ul class="solutions-list">
                    <li>Segera konsultasikan hasil ini kepada dokter atau fasilitas kesehatan, terutama bila gejala memburuk.</li>
                    <li>Cukupi istirahat, cairan, dan ikuti anjuran medis yang sesuai dengan kondisi Anda.</li>
                    <li>Segera cari pertolongan darurat bila mengalami sesak napas berat, nyeri dada, kebiruan, atau penurunan kesadaran.</li>
                    <li>Melakukan isolasi mandiri jika gejala ringan atau dirawat di RS jika sesak napas berat.</li>
                    <li>Konsumsi vitamin C, D, dan Zinc untuk meningkatkan daya tahan tubuh.</li>
                </ul>
            </section>
        </div>
    </main>
</div>
</body>
</html>