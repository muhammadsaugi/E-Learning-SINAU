<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'SINAU')</title>

    <!-- Google Fonts: Inter + DM Serif Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Scripts & Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --cream-50:  #FAF8F4;
            --cream-100: #F3EDE2;
            --cream-200: #EDE5D8;
            --cream-300: #D4C0A0;
            --brown-400: #A87C52;
            --brown-500: #8B6340;
            --brown-600: #6E4A2E;
            --brown-700: #4A2E1A;
            --brown-900: #241508;
        }

        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--cream-200);
            color: var(--brown-700);
        }
        .font-display { font-family: 'DM Serif Display', serif; }
        html, body { height: 100%; margin: 0; }

        /* Tab system */
        .tab-content { display: none; }
        .tab-content.active { display: block; }

        /* Nav item states */
        .nav-item {
            border-radius: 8px;
            transition: background 0.15s ease, color 0.15s ease;
        }
        .nav-item:not(.nav-active):hover {
            background: #3D2211 !important;
            color: #FAF8F4 !important;
        }
        .nav-active {
            background: #4A2E1A !important;
            color: #FAF8F4 !important;
            border: 1px solid #6E4A2E !important;
        }
        .nav-active svg { opacity: 1 !important; color: #FAF8F4 !important; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--cream-300); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--brown-400); }

        /* Modal overlay */
        #modal-overlay { display: none; }
        #modal-overlay.open { display: flex; }

        /* Toast */
        #toast { display: none; }
        #toast.show { display: block; }

        /* Card hover */
        .data-card {
            transition: box-shadow 0.2s ease, transform 0.15s ease;
        }
        .data-card:hover {
            box-shadow: 0 4px 16px rgba(74, 46, 26, 0.1);
            transform: translateY(-1px);
        }

        /* Form inputs */
        .form-input {
            background: var(--cream-50);
            border: 1.5px solid var(--cream-300);
            border-radius: 10px;
            padding: 9px 14px;
            font-size: 13px;
            color: var(--brown-700);
            transition: border-color 0.15s;
            width: 100%;
            font-family: 'Inter', sans-serif;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--brown-500);
            background: white;
        }
        .form-input::placeholder { color: var(--brown-400); opacity: 0.7; }

        /* Grade badges */
        .badge-grade {
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 6px;
            letter-spacing: 0.02em;
        }
        .badge-a { background: #e8f5e9; color: #2e7d32; }
        .badge-b { background: #e3f2fd; color: #1565c0; }
        .badge-c { background: #fff8e1; color: #f57f17; }
        .badge-d { background: #fce4ec; color: #c62828; }

        /* Status pills */
        .pill-lulus { background: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7; }
        .pill-gagal { background: #fce4ec; color: #c62828; border: 1px solid #ef9a9a; }

        /* Progress bar */
        .progress-bar {
            height: 4px;
            border-radius: 99px;
            background: var(--cream-300);
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            border-radius: 99px;
            background: var(--brown-600);
            transition: width 0.6s ease;
        }

        /* Section panel - bg utama konten */
        main {
            background: var(--cream-200) !important;
        }

        /* Content panel dalam main */
        .content-panel {
            background: var(--cream-50);
            border: 1px solid var(--cream-300);
            border-radius: 14px;
        }

        /* Stat card accent variants */
        .stat-accent {
            background: var(--brown-700);
            color: var(--cream-50);
        }
        .stat-warm {
            background: var(--cream-100);
            border: 1px solid var(--cream-300);
        }
    </style>
</head>
<body>

    <!-- Partial Alert / Toast -->
    @include('partials.alert')

    @yield('content')

    <!-- Yield Javascript -->
    @yield('scripts')
</body>
</html>
