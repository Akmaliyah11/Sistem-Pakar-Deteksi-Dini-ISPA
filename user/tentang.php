<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang SI - PAKAR ARI</title>
    <link rel="stylesheet" href="style-tentang.css">
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
        margin: 0px auto;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(4, 120, 87, 0.04);
        border: 1px solid #e2e8f0;
        box-sizing: border-box;
    }

    .content { padding-top: 20px; text-align: left; }

    .main-title {
        text-align: center;
        font-size: 28px;
        font-weight: 800;
        color: #065f46; 
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }

    .main-desc {
        text-align: center;
        font-size: 14px;
        color: #4b5563;
        max-width: 700px;
        margin: 0 auto 40px;
        line-height: 1.6;
    }

    .section-title {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .section-title svg {
        color: #0d9488; 
        flex-shrink: 0;
    }

    .scientific-reference { 
        margin-bottom: 34px; 
        background: #fafafa;
        padding: 20px;
        border-radius: 16px;
        border: 1px solid #f3f4f6;
    }

    .ref-intro {
        font-size: 13px;
        color: #374151;
        margin-bottom: 14px;
        line-height: 1.6;
    }

    .citation-box {
        border-left: 4px solid #10b981; 
        background: #ffffff;
        border-radius: 0 16px 16px 0;
        padding: 16px 20px;
        border-top: 1px solid #e5e7eb;
        border-right: 1px solid #e5e7eb;
        border-bottom: 1px solid #e5e7eb;
        box-shadow: 0 4px 15px rgba(6, 95, 70, 0.02);
    }

    .journal-title {
        font-size: 14px;
        font-weight: 700;
        color: #065f46;
        margin: 0 0 6px 0;
    }

    .paper-title {
        font-size: 13px;
        color: #4b5563;
        line-height: 1.5;
        font-style: italic;
        margin: 0;
    }

    .bottom-grid {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 36px;
        margin-top: 24px;
        align-items: start;
        border-top: 1px solid #e5e7eb;
        padding-top: 34px;
    }

    .vision-text {
        font-size: 13px;
        color: #4b5563;
        line-height: 1.7;
        margin-bottom: 18px;
        margin-top: 0;
    }

    .points-list {
        list-style: none;
        padding-left: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .points-list li {
        font-size: 13px;
        color: #111827;
        font-weight: 600;
        position: relative;
        padding-left: 24px;
        line-height: 1.5;
    }

    .points-list li::before {
        content: "✓";
        position: absolute;
        left: 0;
        top: 0;
        color: #10b981;
        font-weight: 800;
        font-size: 14px;
    }

    .contact-card {
        background: linear-gradient(145deg, #ffffff, #fdfdfd);
        border-radius: 18px;
        padding: 24px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 20px rgba(6, 95, 70, 0.02);
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .contact-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(90deg, #0d9488, #10b981);
    }

    .contact-card:hover {
        transform: translateY(-4px);
        border-color: #a7f3d0;
        box-shadow: 0 15px 30px rgba(6, 95, 70, 0.06);
    }

    .contact-card h3 {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin-top: 4px;
        margin-bottom: 8px;
    }

    .contact-subtitle {
        font-size: 12px;
        color: #6b7280;
        line-height: 1.5;
        margin-bottom: 20px;
        margin-top: 0;
    }

    .contact-links {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 14px;
        padding: 0;
        margin: 0;
    }

    .contact-links li {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .contact-links svg {
        color: #0d9488;
        flex-shrink: 0;
    }

    .contact-links span {
        font-size: 13px;
        color: #374151;
        font-weight: 600;
        transition: color 0.2s ease;
    }
    
    .contact-links li:hover span {
        color: #059669; 
    }

    @media (max-width: 992px) {
        .bottom-grid {
            grid-template-columns: 1fr;
            gap: 30px;
            padding-top: 26px;
        }
        .main-desc { margin-bottom: 34px; }
        .page-container { padding: 16px; }
    }
</style>
<body>
    <?php
    $page_title = "Tentang";
    echo '<div class="header-sticky">';
    @include __DIR__ . '/header.php';
    echo '</div>'; 
    ?>
<div class="page-container">
    <main class="content">
        <h1 class="main-title">Tentang SI - PAKAR ARI</h1>
        <p class="main-desc">
            Inovasi Informatika Medis untuk meningkatkan efisiensi skrining dan pencegahan kesehatan masyarakat secara dini.
        </p>

        <section class="scientific-reference">
            <h2 class="section-title">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                </svg>
                Referensi Ilmiah Akademik
            </h2>

            <p class="ref-intro">Basis pengetahuan (knowledge-base) dan aturan keputusan sistem ini sepenuhnya dikembangkan berdasarkan metodologi riset yang dipublikasikan dalam:</p>

            <div class="citation-box">
                <p class="journal-title">Journal of Engineering and Applied Science Research (JEASR)</p>
                <p class="paper-title">Expert System for Early Detection of Acute Respiratory Infection (ARI) Diseases using Forward Chaining and Certainty Factor Methods</p>
            </div>
        </section>

        <div class="bottom-grid">
            <div class="vision-section">
                <h2 class="section-title">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                    VISI &amp; MISI SISTEM
                </h2>

                <p class="vision-text">
                    Menghadirkan solusi teknologi berbasis pengetahuan (*Knowledge-based Systems*) yang andal, intuitif, dan valid untuk membantu masyarakat awam dalam melakukan pemeriksaan mandiri yang bersifat preventif (pencegahan).
                </p>

                <ul class="points-list">
                    <li>Akurasi Klinis Terarah (Berdasarkan Aturan Pakar Medis)</li>
                    <li>Aksesibilitas Tinggi (Dapat digunakan kapan saja secara fleksibel)</li>
                    <li>Kecepatan Analisis Data Gejala secara Real-time</li>
                </ul>
            </div>

            <div class="contact-card">
                <h3>Hubungi Kami</h3>
                <p class="contact-subtitle">Buka peluang untuk pengembangan sistem pakar lebih lanjut atau kolaborasi riset kesehatan digital:</p>

                <ul class="contact-links">
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <span>Email: lab@si-pakarari</span>
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                        </svg>
                        <span>RI Studio / Open Source</span>
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="3 11 22 2 13 21 11 13 3 11"></polygon>
                        </svg>
                        <span>JEASR Journal Link</span>
                    </li>
                </ul>
            </div>
        </div>
    </main>
</div>
</body>
</html>