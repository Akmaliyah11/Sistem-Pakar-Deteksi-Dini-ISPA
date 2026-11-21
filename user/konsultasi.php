<?php
session_start();
// Perhitungan diagnosis dilakukan setelah markup formulir dibangun; buffer ini
// memastikan header redirect tetap dapat dikirim dengan aman.
ob_start();
include __DIR__ . '/../koneksi.php';

if (empty($_SESSION['id_konsultasi'])) {
    header('Location: beranda.php');
    exit();
}

$id_konsultasi = (int) $_SESSION['id_konsultasi'];
$pasien_query = mysqli_query($koneksi, "SELECT * FROM konsultasi WHERE id_konsultasi = $id_konsultasi");
$pasien = mysqli_fetch_assoc($pasien_query);
if (!$pasien) {
    unset($_SESSION['id_konsultasi']);
    header('Location: beranda.php');
    exit();
}

// Ambil data bobot user sekali di awal (mencegah N+1 query problem)
$pilihan_bobot = [];
$bobot_user = mysqli_query($koneksi, "SELECT * FROM bobot_user ORDER BY nilai ASC");
while ($bu = mysqli_fetch_assoc($bobot_user)) {
    $pilihan_bobot[] = $bu;
}

// Ambil semua gejala dan kelompokkan berdasarkan kode prefix
$gejala_list = [];
$gejala_query = mysqli_query($koneksi, "SELECT * FROM gejala ORDER BY id_gejala ASC");
while ($g = mysqli_fetch_assoc($gejala_query)) {
    $gejala_list[] = $g;
}

// Fungsi untuk render grup gejala
function render_gejala_group($title, $gejala_ids, $all_gejala, $pilihan_bobot) {
    echo "<div class='gejala-group'>";
    echo "<h3>" . htmlspecialchars($title) . "</h3>";
    echo "<div class='gejala-table-container'>";
    echo "<table class='gejala-table'>";
    foreach ($all_gejala as $g) {
        if (in_array($g['kode_gejala'], $gejala_ids)) {
            echo "<tr id='row_".$g['id_gejala']."'>";
            echo "<td><input type='checkbox' name='gejala_check[".$g['id_gejala']."]' value='".$g['id_gejala']."' onchange='toggleCf(this, ".$g['id_gejala'].")'></td>";
            echo "<td><span class='badge-kode'>" . htmlspecialchars($g['kode_gejala']) . "</span> " . htmlspecialchars($g['nama_gejala']) . "</td>";
            echo "<td>";
            echo "<select name='gejala_cf[".$g['id_gejala']."]' id='cf_".$g['id_gejala']."' style='display:none;' disabled>";
            echo "<option value='' disabled selected>-- Pilih Tingkat Keyakinan --</option>";
            foreach ($pilihan_bobot as $bu) {
                echo "<option value='".$bu['nilai']."'>".$bu['keterangan']."</option>";
            }
            echo "</select>";
            echo "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    echo "</div>";
    echo "</div>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar Diagnosis Penyakit</title>
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
        main.content { 
            width: 100%; 
            margin: 10px auto 30px; 
            padding: 32px 24px; 
            background: #ffffff; 
            border-radius: 20px; 
            box-shadow: 0 10px 25px rgba(6, 95, 70, 0.03); 
            border: 1px solid #e5e7eb; 
        }

        .main-title { 
            margin: 0 0 6px; 
            font-size: 26px; 
            color: #065f46; 
            font-weight: 800; 
            letter-spacing: -0.5px;
        }
        .sub-title { 
            margin: 0 0 24px; 
            color: #4b5563; 
            font-size: 14px; 
            line-height: 1.5; 
        }

        .data-pasien { 
            background: #f9fafb; 
            border-left: 4px solid #10b981; 
            padding: 20px; 
            margin-bottom: 28px; 
            border-radius: 0 16px 16px 0;
            border-top: 1px solid #e5e7eb;
            border-right: 1px solid #e5e7eb;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 4px 15px rgba(6, 95, 70, 0.01);
        }
        .data-pasien h3 { 
            margin: 0 0 12px; 
            font-size: 15px; 
            font-weight: 700; 
            color: #111827;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .data-pasien p { 
            margin: 6px 0; 
            font-size: 13px; 
            color: #4b5563; 
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .gejala-group { 
            margin-top: 24px; 
        }
        .gejala-group h3 { 
            color: #1f2937; 
            margin: 28px 0 12px; 
            font-size: 15px; 
            border-left: 4px solid #0d9488; 
            padding-left: 12px; 
            font-weight: 700; 
        }
        .gejala-table-container {
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.01);
        }
        .gejala-table { 
            width: 100%; 
            border-collapse: collapse; 
            background: #ffffff;
        }
        .gejala-table tr {
            transition: background-color 0.15s ease;
        }
        .gejala-table td { 
            padding: 14px 16px; 
            border-bottom: 1px solid #e5e7eb; 
            vertical-align: middle; 
            font-size: 13px;
            color: #374151;
        }
        .gejala-table tr:last-child td { 
            border-bottom: none; 
        }
        .gejala-table tr.selected-row { 
            background-color: #f0fdf4 !important; 
        }
        .gejala-table tr:hover { 
            background-color: #f9fafb; 
        }
        
        .gejala-table td:nth-child(1) { width: 5%; text-align: center; }
        .gejala-table td:nth-child(2) { width: 55%; line-height: 1.5; }
        .gejala-table td:nth-child(3) { width: 40%; }

        .badge-kode {
            color: #0d9488; 
            background: #ccfbf1;
            padding: 2px 6px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            margin-right: 6px;
            display: inline-block;
        }

        input[type="checkbox"] { 
            transform: scale(1.2); 
            cursor: pointer; 
            accent-color: #0d9488; 
        }
        select { 
            width: 100%; 
            padding: 9px 12px; 
            border-radius: 10px; 
            border: 1px solid #d1d5db; 
            background-color: #ffffff; 
            font-size: 13px;
            color: #374151;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.02);
            transition: all 0.2s ease; 
        }
        select:focus {
            outline: none;
            border-color: #0d9488;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15);
        }

        button[type="submit"] { 
            background: linear-gradient(135deg, #0d9488, #10b981); 
            color: #fff; 
            border: none; 
            padding: 14px 28px; 
            font-size: 14px; 
            font-weight: 700; 
            border-radius: 12px; 
            cursor: pointer; 
            transition: all .2s ease; 
            display: flex; 
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%; 
            max-width: 280px; 
            margin: 36px auto 12px; 
            box-shadow: 0 4px 14px rgba(13, 148, 136, 0.25); 
        }
        button[type="submit"]:hover { 
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 148, 136, 0.35);
            filter: brightness(1.05);
        }
        hr { 
            border: 0; 
            height: 1px; 
            background: #e5e7eb; 
            margin: 32px 0; 
        }

        .alert-error {
            padding: 14px;
            background-color: #fef2f2;
            border: 1px solid #fca5a5;
            color: #991b1b;
            border-radius: 12px;
            font-size: 13px;
            margin-top: 20px;
            text-align: center;
            font-weight: 600;
        }

        .hasil-diagnosa ul { list-style: none; padding: 0; margin: 0; }
        .hasil-diagnosa ul li { background: #f0fdf4; padding: 12px 16px; border-left: 4px solid #10b981; margin-bottom: 10px; border-radius: 0 12px 12px 0; color: #111827; font-size: 13px; }
        .hasil-diagnosa ul li i { color: #6b7280; font-size: 12px; }

        .results-table { width: 100%; border-collapse: collapse; margin-top: 18px; font-size: 13px; border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; }
        .results-table th, .results-table td { padding: 12px 14px; text-align: left; }
        .results-table th { background-color: #0f172a; color: white; font-weight: 600; }
        .results-table tr:nth-child(even) { background-color: #f9fafb; }
        .results-table tr:hover { background-color: #f0fdf4; }

        .kesimpulan { background: linear-gradient(145deg, #ffffff, #f0fdf4); border: 1px solid #a7f3d0; color: #065f46; padding: 20px; margin-top: 22px; border-radius: 16px; text-align: center; box-shadow: 0 4px 15px rgba(6, 95, 70, 0.02); }
        .kesimpulan p { margin: 0; font-size: 14px; }
        .kesimpulan b { color: #047857; font-size: 16px; }

        @media (max-width: 768px) { 
            .page-container { padding: 12px; }
            main.content { padding: 20px 16px; } 
            .gejala-table td { padding: 12px 10px; }
            .gejala-table td:nth-child(1) { width: 8%; }
            .gejala-table td:nth-child(2) { width: 92%; display: block; border-bottom: none; padding-bottom: 4px; }
            .gejala-table td:nth-child(3) { width: 100%; display: block; padding-top: 4px; }
            .data-pasien p { flex-direction: column; gap: 4px; }
        }
    </style>
</head>
<body>
<?php $page_title = 'KONSULTASI'; include __DIR__ . '/header.php'; ?>
<div class="page-container">
    <main class="content">
        <h1 class="main-title">Diagnosis Penyakit</h1>
        <div class="data-pasien">
            <h3>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Informasi Pribadi Pasien
            </h3>
            <p><b>Nama:</b> <?= htmlspecialchars($pasien['nama']) ?> <span>•</span> <b>Usia:</b> <?= (int) $pasien['usia'] ?> tahun <span>•</span> <b>Jenis Kelamin:</b> <?= $pasien['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?></p>
            <p><b>Telepon:</b> <?= htmlspecialchars($pasien['nomor_telepon']) ?> <span>•</span> <b>Alamat:</b> <?= htmlspecialchars($pasien['alamat']) ?></p>
        </div>
        <p class="sub-title">Silakan centang gejala klinis yang Anda alami di bawah ini, kemudian tentukan tingkat keyakinan/keparahannya pada kolom pilihan yang muncul.</p>

        <form method="post">
            <?php
            render_gejala_group("1. Gejala Umum (General Constitutional)", 
                ['G002', 'G003', 'G008', 'G009', 'G0019A', 'G0019B', 'G0019C', 'G0020A', 'G0020B', 'G0020C'], 
                $gejala_list, $pilihan_bobot);

            render_gejala_group("2. Gejala Saluran Napas Atas & THT", 
                ['G007', 'G006', 'G010', 'G011', 'G012', 'G013', 'G014', 'G0025', 'G0026'], 
                $gejala_list, $pilihan_bobot);

            render_gejala_group("3. Gejala Saluran Napas Bawah & Batuk", 
                ['G0015A', 'G0015B', 'G0015C', 'G0016C', 'G0016A', 'G0016B', 'G0017A', 'G0017B', 'G0017C', 'G0018A', 'G0018B', 'G0018C', 'G0021', 'G0022', 'G0023'], 
                $gejala_list, $pilihan_bobot);

            render_gejala_group("4. Gejala Sistemik & Otot", 
                ['G004', 'G005', 'G0024'], 
                $gejala_list, $pilihan_bobot);

            render_gejala_group("5. Riwayat & Faktor Risiko", 
                ['G001', 'G0029', 'G0027', 'G0028'], 
                $gejala_list, $pilihan_bobot);
            ?>

            <button type="submit" name="diagnosa">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                Mulai Proses Diagnosa
            </button>
        </form>

<script>
function toggleCf(checkbox, id) {
    const select = document.getElementById('cf_' + id);
    const row = document.getElementById('row_' + id);
    if (checkbox.checked) {
        select.style.display = 'block';
        select.disabled = false;
        select.required = true;
        row.classList.add('selected-row');
    } else {
        select.style.display = 'none';
        select.disabled = true;
        select.required = false;
        select.selectedIndex = 0;
        row.classList.remove('selected-row');
    }
}
</script>

<?php
if (isset($_POST['diagnosa'])) {
    $selected_gejala = [];
    if (isset($_POST['gejala_check']) && is_array($_POST['gejala_check'])) {
        foreach ($_POST['gejala_check'] as $id_gejala_checked) {
            $id_gejala = (int)$id_gejala_checked;
            $cf_user = isset($_POST['gejala_cf'][$id_gejala]) ? (float)$_POST['gejala_cf'][$id_gejala] : 0;
            if ($cf_user >= 0) {
                $selected_gejala[$id_gejala] = $cf_user;
            }
        }
    }

    if (empty($selected_gejala)) {
        echo "<div class='alert-error'>Anda belum memilih gejala apapun. Silakan centang minimal satu gejala untuk memulai diagnosis.</div>";
    } else {
        $gejala_ids_string = implode(",", array_keys($selected_gejala));
        $rules_query = mysqli_query($koneksi, "
            SELECT bp.id_penyakit, p.kode_penyakit, p.nama_penyakit, bp.id_gejala, g.kode_gejala, bp.bobot 
            FROM bobot_pakar bp
            JOIN penyakit p ON bp.id_penyakit = p.id_penyakit
            JOIN gejala g ON bp.id_gejala = g.id_gejala
            WHERE bp.id_gejala IN ($gejala_ids_string)
        ");

        $candidate_penyakit = [];
        if ($rules_query) {
            while ($rule = mysqli_fetch_assoc($rules_query)) {
                $id_penyakit = $rule['id_penyakit'];
                if (!isset($candidate_penyakit[$id_penyakit])) {
                    $candidate_penyakit[$id_penyakit] = [
                        'kode' => $rule['kode_penyakit'],
                        'nama' => $rule['nama_penyakit'],
                        'rules' => []
                    ];
                }
                $candidate_penyakit[$id_penyakit]['rules'][] = $rule;
            }
        }

        $hasil = [];
        foreach ($candidate_penyakit as $id_penyakit => $penyakit_data) {
            $cf_lama = 0;
            $pertama = true;
            $matched_gejala = [];

            foreach ($penyakit_data['rules'] as $rule) {
                $id_gejala = $rule['id_gejala'];
                $cf_pakar = $rule['bobot'];
                $cf_user = isset($selected_gejala[$id_gejala]) ? $selected_gejala[$id_gejala] : 0; 

                $cf = $cf_user * $cf_pakar;
                $matched_gejala[] = "[" . $rule['kode_gejala'] . "]";

                if ($pertama) {
                    $cf_lama = $cf;
                    $pertama = false;
                } else {
                    $cf_lama = $cf_lama + ($cf * (1 - $cf_lama));
                }
            }

            $hasil[] = [
                'kode' => $penyakit_data['kode'],
                'penyakit' => $penyakit_data['nama'],
                'cf' => $cf_lama,
                'rule_path' => 'IF ' . implode(' AND ', $matched_gejala) . ' THEN ' . $penyakit_data['kode']
            ];
        }

        if (!empty($hasil)) {
            usort($hasil, function($a, $b) {
                return $b['cf'] <=> $a['cf'];
            });

            $hasil_tertinggi = $hasil[0];
            $gejala_terpilih = json_encode($selected_gejala);
            $stmt_hasil = mysqli_prepare($koneksi, 'INSERT INTO hasil_diagnosa (id_konsultasi, id_penyakit, nilai_cf, persentase, gejala_terpilih) VALUES (?, (SELECT id_penyakit FROM penyakit WHERE kode_penyakit = ? LIMIT 1), ?, ?, ?)');
            $persentase = $hasil_tertinggi['cf'] * 100;
            mysqli_stmt_bind_param($stmt_hasil, 'isdds', $id_konsultasi, $hasil_tertinggi['kode'], $hasil_tertinggi['cf'], $persentase, $gejala_terpilih);
            mysqli_stmt_execute($stmt_hasil);

            $gejala_dipilih = [];
            foreach ($selected_gejala as $id_g => $cf_val) {
                foreach ($gejala_list as $gejala) {
                    if ((int) $gejala['id_gejala'] === (int) $id_g) {
                        $keterangan_cf = '';
                        foreach ($pilihan_bobot as $pilihan) {
                            if ((float) $pilihan['nilai'] === (float) $cf_val) {
                                $keterangan_cf = $pilihan['keterangan'];
                                break;
                            }
                        }
                        $gejala_dipilih[] = [
                            'kode' => $gejala['kode_gejala'],
                            'nama' => $gejala['nama_gejala'],
                            'keyakinan' => $keterangan_cf
                        ];
                        break;
                    }
                }
            }
            $_SESSION['hasil_diagnosa'] = $hasil;
            $_SESSION['gejala_dipilih'] = $gejala_dipilih;
            ob_end_clean();
            header('Location: hasildiagnosa.php');
            exit();
?>
            <hr>
            <div class="hasil-diagnosa">
                <h3>Gejala yang Anda Alami:</h3>
                <ul>
                    <?php
                    foreach ($selected_gejala as $id_g => $cf_val) {
                        $cf_text = "";
                        foreach ($pilihan_bobot as $pb) {
                            if ((float)$pb['nilai'] === (float)$cf_val) {
                                $cf_text = $pb['keterangan'];
                                break;
                            }
                        }
                        $nama_g = ""; $kode_g = "";
                        foreach ($gejala_list as $gl) {
                            if ((int)$gl['id_gejala'] === (int)$id_g) {
                                $nama_g = $gl['nama_gejala'];
                                $kode_g = $gl['kode_gejala'];
                                break;
                            }
                        }
                        echo "<li><span class='badge-kode'>$kode_g</span> $nama_g - <i>Tingkat Keyakinan: $cf_text</i></li>";
                    }
                    ?>
                </ul>
            </div>

            <h2 style="font-size:18px; margin-top:24px; color:#065f46;">Hasil Diagnosa Sementara</h2>
            <table class="results-table">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Penyakit</th>
                    <th>Aturan Forward Chaining</th>
                    <th>Nilai CF</th>
                    <th>Persentase</th>
                </tr>
                <?php
                $no = 1;
                foreach ($hasil as $h) {
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><b><?= $h['kode'] ?></b></td>
                    <td><?= $h['penyakit'] ?></td>
                    <td style="font-family: monospace; font-size:12px; color:#4b5563;"><?= $h['rule_path'] ?></td>
                    <td><?= number_format($h['cf'], 4) ?></td>
                    <td style="font-weight:700; color:#0d9488;"><?= number_format($h['cf'] * 100, 2) ?>%</td>
                </tr>
                <?php } ?>
            </table>

            <div class="kesimpulan">
                <p>Berdasarkan gejala yang dipilih, diagnosis tertinggi adalah <b><?= htmlspecialchars($hasil[0]['penyakit']) ?></b> dengan tingkat keyakinan <b><?= number_format($hasil[0]['cf'] * 100, 2) ?>%</b>.</p>
            </div>
<?php 
        } else {
            echo "<div class='alert-error'>Tidak ada penyakit yang cocok dengan kombinasi gejala yang Anda pilih.</div>";
        }
    } 
} 
?>
</main>
</div>
</body>
</html>