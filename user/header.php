<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
/* --- HEADER / NAVBAR --- */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 40px; 
    background-color: #fffff; 
    width: 100vw;
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
    box-sizing: border-box;
    border-bottom: 1px solid #e5e7eb;
}
.logo-area {
    display: flex;
    align-items: center;
    gap: 10px;
}
.logo-icon {
    font-size: 28px;
    color: #374151;
}
.logo-title {
    display: block;
    font-weight: 800;
    font-size: 14px;
    letter-spacing: 1px;
    color: #1f2937;
}
.logo-subtitle {
    display: block;
    font-size: 10px;
    font-weight: bold;
    color: #6b7280;
}
.nav-links {
    display: flex;
    gap: 25px;
}
.nav-links a {
    text-decoration: none;
    font-size: 12px;
    font-weight: bold;
    color: #4b5563;
    transition: color 0.2s;
}
.nav-links a:hover, .nav-links a.active {
    color: #059669; 
}
.header-sticky {
    position: -webkit-sticky; 
    position: sticky;
    top: 0;
    z-index: 1000; 
    background-color: white; 
    padding-top: 10px; 
}
.content {
    padding-top: 20px; 
}

</style>
<header class="navbar">
    <div class="logo-area">
        <i class="fa-solid fa-heart-pulse logo-icon"></i>
        <div>
            <span class="logo-title">EXPERT ARI</span>
            <span class="logo-subtitle">SISTEM DETEKSI</span>
        </div>
    </div>
    <nav class="nav-links">
        <a href="beranda.php" class="<?= ($page_title == 'Beranda') ? 'active' : ''; ?>">BERANDA</a>
        <a href="informasi.php" class="<?= ($page_title == 'Informasi') ? 'active' : ''; ?>">INFORMASI</a>
        <a href="deteksi.php" class="<?= ($page_title == 'Deteksi') ? 'active' : ''; ?>">CARA DETEKSI</a>
        <a href="tentang.php" class="<?= ($page_title == 'Tentang') ? 'active' : ''; ?>">TENTANG</a>
        <!-- <a href="konsultasi.php" class="<?= ($page_title == 'KONSULTASI') ? 'active' : ''; ?>">KONSULTASI</a>   -->
        <!-- <a href="hasildiagnosa.php" class="<?= ($page_title == 'HASIL') ? 'active' : ''; ?>">HASIL</a>    -->
</nav>
</header>
