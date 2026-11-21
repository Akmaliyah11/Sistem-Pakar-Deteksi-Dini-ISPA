<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Informasi - Mengenal ISPA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style-info.css">
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
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(4, 120, 87, 0.04);
        border: 1px solid #e2e8f0;
        box-sizing: border-box;
    }

    .content { text-align: center; padding: 10px 0 20px; }

    .main-title {
        font-size: 32px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 12px;
    }

    .main-title::after {
        content: '';
        display: block;
        width: 60px;
        height: 4px;
        background: #10b981;
        border-radius: 2px;
        margin: 12px auto 0 auto;
    }

    .main-desc {
        font-size: 14px;
        color: #475569;
        line-height: 1.6;
        margin-bottom: 32px;
    }

    .overview-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        max-width: 900px;
        margin: 0 auto 40px auto;
        text-align: left;
    }

    .overview-item {
        display: flex;
        gap: 16px;
        align-items: flex-start;
        background: #f8fafc;
        padding: 20px;
        border-radius: 16px;
        border: 1px solid #f1f5f9;
        transition: transform 0.2s ease;
    }
    
    .overview-item:hover {
        transform: translateY(-2px);
    }

    .overview-icon {
        font-size: 28px;
        color: #0f766e; /* Teal murni */
        background: #ccfbf1;
        padding: 12px;
        border-radius: 12px;
    }

    .overview-text h3 {
        font-size: 16px;
        font-weight: 700;
        color: #0f766e;
        margin-top: 0;
        margin-bottom: 10px;
    }

    .overview-text ul { list-style: none; padding-left: 0; margin: 0; }

    .overview-text li {
        font-size: 13px;
        color: #475569;
        margin-bottom: 8px;
        position: relative;
        padding-left: 16px;
        line-height: 1.4;
    }

    .overview-text li::before {
        content: "•";
        position: absolute;
        left: 0;
        top: 0;
        color: #10b981;
        font-weight: bold;
    }

    .section-title {
        font-size: 18px;
        font-weight: 800;
        color: #0f172a;
        text-align: left;
        margin: 0 auto 20px auto;
        max-width: 1120px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-icon { color: #f59e0b; }

    .disease-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin: 0 auto 40px auto;
        max-width: 1120px;
    }

    .disease-card {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px;
        text-align: left;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.02);
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .disease-card:hover {
        transform: translateY(-4px);
        border-color: #99f6e4;
        box-shadow: 0 12px 24px rgba(15, 118, 110, 0.06);
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }

    .card-header i { font-size: 18px; }
    .icon-tb { color: #0284c7; }       
    .icon-covid { color: #ef4444; }    
    .icon-diph { color: #db2777; }     
    .icon-pneu { color: #0f766e; }     

    .card-header h3 {
        font-size: 14px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .disease-card p {
        font-size: 12px;
        color: #64748b;
        line-height: 1.6;
        margin: 0;
    }

    .cta-banner {
        background: linear-gradient(135deg, #0f766e 0%, #065f46 100%);
        border: none;
        border-radius: 20px;
        padding: 30px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        text-align: left;
        max-width: 1120px;
        margin: 0 auto;
        box-shadow: 0 10px 30px rgba(15, 118, 110, 0.2);
        color: #ffffff;
    }

    .cta-text h3 {
        font-size: 20px;
        font-weight: 700;
        color: #ffffff;
        margin-top: 0;
        margin-bottom: 8px;
    }

    .cta-text p {
        font-size: 14px;
        color: #ccfbf1;
        margin-top: 0;
        margin-bottom: 20px;
        max-width: 550px;
        line-height: 1.5;
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

    .cta-image-placeholder {
        background-color: rgba(255, 255, 255, 0.15);
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(4px);
    }

    .doctor-icon {
        font-size: 36px;
        color: #ffffff;
    }

    @media (max-width: 900px) {
        .page-container { margin: 10px; padding: 16px; }
        .overview-grid { grid-template-columns: 1fr; gap: 16px; }
        .disease-grid { grid-template-columns: 1fr 1fr; gap: 14px; }
        .cta-banner { flex-direction: column-reverse; align-items: flex-start; gap: 20px; padding: 24px; }
        .cta-image-placeholder { display: none; } /* Sembunyikan lingkaran di mobile agar ringkas */
    }

    @media (max-width: 560px) {
        .disease-grid { grid-template-columns: 1fr; }
        .main-title { font-size: 26px; }
        .section-title { font-size: 16px; }
    }
</style>

<body>
    <?php
    $page_title = "Informasi";
    echo '<div class="header-sticky">';
    @include __DIR__ . '/header.php';
    echo '</div>';
    ?>
<div class="page-container">
    <main class="content">
        <h1 class="main-title">Mengenal ISPA</h1>
        <p class="main-desc">
            Infeksi Saluran Pernapasan Akut (ISPA) adalah infeksi yang menyerang saluran pernapasan, <br>
            baik di bagian atas maupun bawah.
        </p>

        <div class="overview-grid">
            <div class="overview-item">
                <i class="fa-solid fa-temperature-three-quarters overview-icon"></i>
                <div class="overview-text">
                    <h3>Gejala Umum</h3>
                    <ul>
                        <li>Batuk kering atau berdahak</li>
                        <li>Demam tinggi di atas 38 °C</li>
                        <li>Sesak napas atau nyeri dada</li>
                        <li>Lemas dan kurang nafsu makan</li>
                    </ul>
                </div>
            </div>

            <div class="overview-item">
                <i class="fa-solid fa-shield-halved overview-icon"></i>
                <div class="overview-text">
                    <h3>Langkah Pencegahan</h3>
                    <ul>
                        <li>Mencuci tangan secara teratur</li>
                        <li>Menggunakan masker di tempat umum</li>
                        <li>Menjaga daya tahan tubuh (Nutrisi)</li>
                        <li>Vaksinasi (BCG, DPT, COVID)</li>
                    </ul>
                </div>
            </div>
        </div>

        <h2 class="section-title">
            <i class="fa-solid fa-triangle-exclamation alert-icon"></i>
            Penyakit yang Terdeteksi Sistem
        </h2>

        <div class="disease-grid">
            <div class="disease-card">
                <div class="card-header">
                    <i class="fa-solid fa-virus icon-tb"></i>
                    <h3>Tuberkulosis (TB)</h3>
                </div>
                <p>Penyakit menular paru-paru yang disebabkan oleh bakteri Mycobacterium tuberculosis. Sering kali ditandai dengan batuk berkepanjangan lebih dari 3 minggu.</p>
            </div>

            <div class="disease-card">
                <div class="card-header">
                    <i class="fa-solid fa-virus-covid icon-covid"></i>
                    <h3>COVID-19</h3>
                </div>
                <p>Penyakit menular yang disebabkan oleh virus SARS-CoV-2. Gejala bervariasi dari flu ringan hingga sesak napas berat dan kehilangan indra perasa/penciuman.</p>
            </div>

            <div class="disease-card">
                <div class="card-header">
                    <i class="fa-solid fa-bacteria icon-diph"></i>
                    <h3>Diphtheria</h3>
                </div>
                <p>Infeksi bakteri serius yang memengaruhi selaput lendir hidung dan tenggorokan. Ditandai dengan adanya selaput abu-abu pada amandel.</p>
            </div>

            <div class="disease-card">
                <div class="card-header">
                    <i class="fa-solid fa-lungs icon-pneu"></i>
                    <h3>Pneumonia</h3>
                </div>
                <p>Infeksi yang memicu inflamasi pada kantung udara di salah satu atau kedua paru-paru, yang dapat berisi cairan atau nanah.</p>
            </div>
        </div>

        <div class="cta-banner">
            <div class="cta-text">
                <h3>Segera Lakukan Deteksi Dini</h3>
                <p>Jangan abaikan gejala yang Anda rasakan. Kecepatan penanganan dapat mempercepat proses pemulihan.</p>
                <div>
                    <a class="btn-retry" href="beranda.php">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px; display: inline-block; vertical-align: middle;">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                    Mulai Konsultasi
                </a>
                </div>
            </div>
            <div class="cta-image-placeholder">
                <i class="fa-solid fa-user-doctor doctor-icon"></i>
            </div>
        </div>
    </main>
</div>
</body>
</html>