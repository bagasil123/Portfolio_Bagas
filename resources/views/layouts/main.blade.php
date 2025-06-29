<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio Website | Bagas Indra Lesmana</title>
    
    {{-- Memuat file CSS dari folder public --}}
    <link rel="stylesheet" href="https://portfolio-bagas-fnz2dnd6dskauhdd.southeastasia-01.azurewebsites.net/css/styles.css">
    <script src="https://portfolio-bagas-fnz2dnd6dskauhdd.southeastasia-01.azurewebsites.net/js/script.js"></script>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <meta name="description" content="Portofolio Bagas Indra Lesmana. Junior developer untuk web dan mobile.">

</head>
<body>
    {{-- Welcome screen tidak berubah --}}
    <div class="welcome-screen" id="welcomeScreen">
        <div class="welcome-content">
            <h1 class="welcome-title">Bagas Indra Lesmana</h1>
            <p class="welcome-subtitle">Welcome to my portfolio website</p>
            <button class="enter-btn" onclick="enterSite()">Enter the portfolio</button>
        </div>
    </div>

    {{-- Kursor dan Canvas Background --}}
    <div class="cursor"></div>
    <canvas class="bg-canvas"></canvas>

    {{-- ======================================================= --}}
    {{-- KONTEN UTAMA DARI welcome.blade.php AKAN MUNCUL DI SINI --}}
    {{-- ======================================================= --}}
    @yield('content')

    {{-- Memuat semua file JavaScript di akhir untuk performa yang lebih baik --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
