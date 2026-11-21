<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Kerja Deteksi</title>
    <link rel="stylesheet" href="style-cara.css">
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

    .content { text-align: center; padding: 10px 0 20px; }

    .main-title {
        font-size: 28px; 
        font-weight: 800;
        color: #065f46; 
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }

    .main-desc {
        font-size: 14px;
        color: #4b5563;
        max-width: 700px; 
        margin: 0 auto 40px;
        line-height: 1.6;
    }

    .steps-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px; 
        margin-bottom: 50px;
    }

    .step-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 24px 16px;
        border-radius: 16px; 
        background: #ffffff;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 15px rgba(6, 95, 70, 0.03);
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .step-item::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(90deg, #10b981, #06b6d4);
        opacity: 0;
        transition: opacity 0.25s ease;
    }

    .step-item:hover {
        transform: translateY(-4px);
        border-color: #a7f3d0;
        box-shadow: 0 15px 25px -5px rgba(6, 95, 70, 0.06);
    }

    .step-item:hover::before {
        opacity: 1;
    }

    .step-item:nth-child(1) .icon-wrapper { background: #eff6ff; color: #2563eb; border-color: #dbeafe; }
    .step-item:nth-child(2) .icon-wrapper { background: #fef3c7; color: #d97706; border-color: #fde68a; }
    .step-item:nth-child(3) .icon-wrapper { background: #f5f3ff; color: #7c3aed; border-color: #edd9ff; }
    .step-item:nth-child(4) .icon-wrapper { background: #ecfdf5; color: #059669; border-color: #a7f3d0; }

    .icon-wrapper {
        width: 60px;
        height: 60px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 14px;
        border-radius: 14px;
        border: 1px solid;
    }

    .icon-wrapper svg {
        width: 26px;
        height: 26px;
    }

    .step-item h3 {
        font-size: 15px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 8px;
    }

    .step-item p {
        font-size: 13px;
        color: #4b5563;
        line-height: 1.5;
        margin: 0;
    }

    .bottom-grid {
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 32px; 
        text-align: left;
        border-top: 1px solid #e5e7eb;
        padding-top: 40px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .tag-label {
        font-size: 11px;
        font-weight: 800;
        color: #059669;
        letter-spacing: 1.5px;
        margin-bottom: 8px;
        display: inline-block;
        background: #d1fae5;
        padding: 4px 10px;
        border-radius: 6px;
    }

    .section-title {
        font-size: 24px;
        font-weight: 800;
        color: #111827;
        margin-top: 5px;
        margin-bottom: 14px;
    }

    .section-text {
        font-size: 14px;
        color: #4b5563;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .formula-box {
        background: linear-gradient(135deg, #f0fdfa, #ecfdf5);
        border: 1px solid #a7f3d0;
        border-radius: 16px;
        padding: 18px;
        font-family: 'Fira Code', 'Courier New', Courier, monospace;
        box-shadow: 0 8px 20px rgba(6, 95, 70, 0.03);
    }

    .formula-comment {
        color: #059669;
        font-size: 12px;
        font-weight: 600;
        display: block;
        margin-bottom: 8px;
    }

    .formula-line {
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
        margin: 6px 0;
        letter-spacing: 0.5px;
    }

    .formula-line sub { font-size: 10px; color: #64748b; }

    .education-card {
        background: linear-gradient(145deg, #ffffff, #f9fafb);
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 24px;
        display: flex;
        flex-direction: column;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.01);
        transition: all 0.25s ease;
    }

    .education-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.04);
    }

    .education-card .card-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    .education-card .card-header svg {
        width: 22px;
        height: 22px;
        color: #0d9488;
    }

    .education-card .card-header h3 {
        font-size: 17px;
        font-weight: 800;
        color: #111827;
        margin: 0;
    }

    .card-subtitle {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 18px;
        margin-top: 0;
    }

    .benefit-list {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 14px;
        padding: 0;
        margin: 0;
    }

    .benefit-list li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .list-icon {
        color: #10b981;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .benefit-list span {
        font-size: 13px;
        color: #374151;
        line-height: 1.5;
    }

    @media (max-width: 992px) {
        .steps-container {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .bottom-grid {
            grid-template-columns: 1fr;
            gap: 30px;
            padding: 35px 16px 0;
        }
    }

    @media (max-width: 576px) {
        .steps-container {
            grid-template-columns: 1fr;
        }
        .main-title { font-size: 24px; }
    }
</style>
<body>
    <?php
    $page_title = "Deteksi";
    echo '<div class="header-sticky">';
    @include __DIR__ . '/header.php';
    echo '</div>';
    ?>
<div class="page-container">
    <main class="content">
        <h1 class="main-title">Cara Kerja Deteksi</h1>
        <p class="main-desc">
            Sistem ini menggunakan kecerdasan buatan berbasis algoritma medis untuk mengevaluasi input gejala Anda secara cepat, akurat, dan objektif.
        </p>

        <div class="steps-container">
            <!-- Langkah 1 -->
            <div class="step-item">
                <div class="icon-wrapper">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <h3>Informasi Pribadi</h3>
                <p>Masukkan data diri dasar Anda untuk dokumentasi dan identifikasi awal.</p>
            </div>

            <!-- Langkah 2 -->
            <div class="step-item">
                <div class="icon-wrapper">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                </div>
                <h3>Penilaian Gejala</h3>
                <p>Pilih tingkat keyakinan Anda terhadap indikasi gejala kesehatan yang dirasakan.</p>
            </div>

            <!-- Langkah 3 -->
            <div class="step-item">
                <div class="icon-wrapper">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                    </svg>
                </div>
                <h3>Inference Engine</h3>
                <p>Sistem cerdas memproses data menggunakan metode Forward Chaining & Certainty Factor.</p>
            </div>

            <!-- Langkah 4 -->
            <div class="step-item">
                <div class="icon-wrapper">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <h3>Hasil Diagnosis</h3>
                <p>Dapatkan persentase kepastian tingkat akurasi penyakit beserta saran medisnya.</p>
            </div>
        </div>

        <div class="bottom-grid">
            <!-- Bagian Metodologi -->
            <div class="methodology-section">
                <div>
                    <span class="tag-label">METODOLOGI SISTEM</span>
                </div>
                <h2 class="section-title">Certainty Factor (CF)</h2>
                <p class="section-text">
                    Metode Certainty Factor digunakan untuk mengakomodasi nilai ketidakpastian pikiran seorang pakar medis. Dengan mengombinasikan beberapa bobot gejala, sistem mampu mengkalkulasi tingkat keyakinan final secara matematis.
                </p>

                <div class="formula-box">
                    <span class="formula-comment">// Rumus Akumulasi Gejala</span>
                    <p class="formula-line">CF[H,E]<sub>1</sub> = CF[H] * CF[E]</p>
                    <p class="formula-line">CF<sub>combine</sub> = CF<sub>old</sub> + CF<sub>baru</sub> * (1 - CF<sub>old</sub>)</p>
                </div>
            </div>

            <!-- Bagian Edukasi -->
            <div class="education-card">
                <div class="card-header">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                    <h3>Edukasi &amp; Pencegahan</h3>
                </div>
                <p class="card-subtitle">Manfaat utama melakukan deteksi dini secara berkala:</p>

                <ul class="benefit-list">
                    <li>
                        <svg class="list-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span><strong>Sistem Peringatan Dini:</strong> Mendeteksi potensi gangguan kesehatan lebih cepat sebelum memburuk.</span>
                    </li>
                    <li>
                        <svg class="list-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span><strong>Rujukan Awal Terpercaya:</strong> Sebagai panduan awal yang objektif sebelum Anda pergi ke laboratorium atau klinik.</span>
                    </li>
                    <li>
                        <svg class="list-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span><strong>Edukasi Bahaya ISPA:</strong> Membantu meningkatkan kesadaran publik mengenai infeksi saluran pernapasan akut.</span>
                    </li>
                </ul>
            </div>
        </div>
    </main>
</div>
</body>
</html>