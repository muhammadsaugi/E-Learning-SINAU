<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'SINAU')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Scripts & Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Outfit', sans-serif; }
        .font-serif { font-family: 'Lora', serif; }
        html, body { height: 100%; margin: 0; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        .nav-active { background-color: #7A5C3A !important; color: #FAF7F2 !important; }
        .nav-item:not(.nav-active):hover { background-color: rgba(212,197,169,0.6); }
        #modal-overlay { display: none; }
        #modal-overlay.open { display: flex; }
        #toast { display: none; }
        #toast.show { display: block; }
    </style>
</head>
<body class="bg-[#F7F3EC] h-full">

    <!-- Partial Alert / Toast -->
    @include('partials.alert')

    <!-- Yield Area Konten Utama -->
    @yield('content')

    <!-- Yield Javascript -->
    @yield('scripts')
</body>
</html>
