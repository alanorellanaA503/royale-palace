<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- FAVICON --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

    <title>@yield('title', 'The Royale Palace — Sabores Auténticos de El Salvador')</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ── VARIABLES ROYALE PALACE ── */
        :root {
            --color-gold: #C8A24D;
            --color-gold-hover: #A8862C;
            --color-green: #305D42;
            --color-dark: #111111;
            --color-muted: #555555;
            --color-line: #E5E5E5;
            --color-bg: #FFFFFF;
            --color-bg-soft: #F8F8F8;
            --font-main: 'Montserrat', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-main);
            background: var(--color-bg);
            color: var(--color-dark);
            overflow-x: hidden;
        }

        /* ── NAVBAR ── */


        /* Botón admin elegante */
        .btn-admin-dashboard {
            background: linear-gradient(135deg, #1e1e2f 0%, #1a1a2e 100%);
            border: 1px solid rgba(200, 162, 77, 0.3);
            transition: all 0.3s ease;
        }

        .btn-admin-dashboard:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            border-color: var(--color-gold);
        }

        .btn-admin-dashboard i {
            transition: transform 0.3s ease;
        }

        .btn-admin-dashboard:hover i {
            transform: scale(1.1);
        }


        .trp-navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 0 2rem;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(8px);
            border-bottom: 0.5px solid transparent;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .trp-navbar.scrolled {
            border-bottom-color: var(--color-line);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        }

        /* Logo Brand Section */
        .trp-logo-section {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            z-index: 1001;
        }

        .trp-logo-img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .trp-logo-section:hover .trp-logo-img {
            transform: scale(1.05);
        }

        .trp-logo {
            font-size: 1rem;
            font-weight: 800;
            letter-spacing: 2.5px;
            color: var(--color-dark);
            text-decoration: none;
            text-transform: uppercase;
            transition: color 0.2s;
        }

        .trp-logo span {
            color: var(--color-gold);
        }

        /* Nav Links Container */
        .trp-nav-links {
            display: flex;
            align-items: center;
            gap: 0;
            list-style: none;
        }

        .trp-nav-links li {
            position: relative;
        }

        .trp-nav-links a {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--color-dark);
            text-decoration: none;
            transition: color 0.2s;
            padding: 12px 18px;
            display: flex;
            align-items: center;
            gap: 6px;
            position: relative;
        }

        .trp-nav-links a::after {
            content: '';
            position: absolute;
            bottom: 8px;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--color-gold);
            transition: width 0.3s ease, left 0.3s ease;
        }

        .trp-nav-links a:hover::after,
        .trp-nav-links a.active::after {
            width: 80%;
            left: 10%;
        }

        .trp-nav-links a:hover,
        .trp-nav-links a.active {
            color: var(--color-gold);
        }

        /* Dropdown Menu */
        .nav-dropdown {
            position: relative;
        }

        .nav-dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .nav-dropdown-icon {
            font-size: 0.5rem;
            transition: transform 0.3s ease;
        }

        .nav-dropdown.active .nav-dropdown-icon {
            transform: rotate(180deg);
        }

        .nav-dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(8px);
            border-radius: 8px;
            padding: 0.5rem 0;
            min-width: 180px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px);
            transition: all 0.3s ease;
            z-index: 100;
            border: 1px solid rgba(200, 162, 77, 0.15);
            margin-top: 8px;
        }

        .nav-dropdown.active .nav-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .nav-dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            color: var(--color-dark);
            text-decoration: none;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
            position: relative;
        }

        .nav-dropdown-menu a::after {
            display: none;
        }

        .nav-dropdown-menu a:hover {
            background: rgba(200, 162, 77, 0.08);
            color: var(--color-gold);
            border-left-color: var(--color-gold);
            padding-left: 20px;
        }

        .nav-dropdown-menu a::before {
            content: '';
            width: 4px;
            height: 4px;
            background: var(--color-gold);
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .nav-dropdown-menu a:hover::before {
            opacity: 1;
        }

        /* Right Section */
        .trp-nav-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn-reservar-nav {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 10px 24px;
            background: var(--color-gold);
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
        }

        .btn-reservar-nav::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--color-gold-hover);
            transition: left 0.3s;
            z-index: -1;
        }

        .btn-reservar-nav:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(200, 162, 77, 0.3);
        }

        .btn-reservar-nav:hover::before {
            left: 0;
        }

        .auth-section {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding-left: 1rem;
            border-left: 1px solid rgba(0, 0, 0, 0.1);
        }

        .auth-section a {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--color-dark);
            text-decoration: none;
            transition: color 0.2s;
            padding: 12px 14px;
        }

        .auth-section a:hover {
            color: var(--color-gold);
        }

        .logout-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-family: var(--font-main);
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--color-dark);
            padding: 12px 14px;
            transition: color 0.2s;
        }

        .logout-btn:hover {
            color: var(--color-gold);
        }

        .admin-badge {
            background: var(--color-gold);
            color: #fff;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 1px;
            margin-left: 4px;
        }

        /* Mobile Menu Icon */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--color-dark);
            transition: color 0.2s;
            z-index: 1001;
        }

        .mobile-menu-toggle:hover {
            color: var(--color-gold);
        }

        /* Mobile Menu */
        .mobile-menu {
            display: none;
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.99);
            backdrop-filter: blur(8px);
            z-index: 999;
            overflow-y: auto;
            padding: 2rem;
            animation: slideDown 0.3s ease forwards;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .mobile-menu.active {
            display: block;
        }

        .mobile-menu-item {
            padding: 1rem 0;
            border-bottom: 1px solid var(--color-line);
        }

        .mobile-menu-item a,
        .mobile-menu-item button {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-dark);
            text-decoration: none;
            border: none;
            background: none;
            cursor: pointer;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .mobile-menu-item a:hover,
        .mobile-menu-item button:hover {
            color: var(--color-gold);
        }

        /* Mobile Submenu */
        .mobile-submenu {
            display: none;
            padding: 1rem 0 0 2rem;
            border-left: 2px solid var(--color-gold);
            margin-left: 1rem;
            margin-top: 1rem;
        }

        .mobile-submenu.active {
            display: block;
        }

        .mobile-submenu a {
            padding: 0.75rem 0;
            font-size: 0.7rem;
            color: var(--color-muted);
        }

        .mobile-submenu a:hover {
            color: var(--color-gold);
        }

        /* Mobile CTA Buttons */
        .mobile-menu-footer {
            padding-top: 2rem;
            margin-top: 2rem;
            border-top: 1px solid var(--color-line);
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .mobile-menu-footer a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.2s;
            border: none;
        }

        .mobile-menu-footer .btn-reservar {
            background: var(--color-gold);
            color: #fff;
        }

        .mobile-menu-footer .btn-reservar:hover {
            background: var(--color-gold-hover);
            transform: translateY(-2px);
        }

        .mobile-menu-footer .btn-login {
            background: transparent;
            color: var(--color-dark);
            border: 1.5px solid var(--color-line);
        }

        .mobile-menu-footer .btn-login:hover {
            border-color: var(--color-gold);
            color: var(--color-gold);
        }

        /* ── BOTONES GLOBALES ── */
        .btn-gold {
            display: inline-block;
            padding: 14px 36px;
            background: var(--color-gold);
            color: #fff;
            font-family: var(--font-main);
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.25s, transform 0.2s;
        }

        .btn-gold:hover {
            background: var(--color-gold-hover);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-outline-gold {
            display: inline-block;
            padding: 13px 34px;
            background: transparent;
            color: var(--color-gold);
            font-family: var(--font-main);
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            text-decoration: none;
            border: 1.5px solid var(--color-gold);
            cursor: pointer;
            transition: all 0.25s;
        }

        .btn-outline-gold:hover {
            background: var(--color-gold);
            color: #fff;
        }

        /* ── SECCIÓN GENÉRICA ── */
        .trp-section {
            padding: 100px 0;
        }

        .trp-section-sm {
            padding: 60px 0;
        }

        .section-label {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--color-gold);
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: clamp(1.8rem, 4vw, 3rem);
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-dark);
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }

        .section-subtitle {
            font-size: 0.95rem;
            font-weight: 400;
            color: var(--color-muted);
            line-height: 1.8;
            max-width: 560px;
        }

        .gold-divider {
            width: 50px;
            height: 2px;
            background: var(--color-gold);
            margin: 1.5rem 0;
        }

        /* ── FOOTER MEJORADO ── */
        .trp-footer {
            position: relative;
            background: #1a1a1a;
            color: rgba(255, 255, 255, 0.6);
            padding: 60px 0 30px;
            margin-top: 100px;
        }

        .trp-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--color-gold), transparent);
        }

        /* Footer Top Section - Brand + Tagline */
        .footer-header {
            display: flex;
            align-items: flex-start;
            gap: 2rem;
            margin-bottom: 4rem;
            padding-bottom: 3rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .footer-brand-group {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 1.2rem;
            min-width: 220px;
        }

        .footer-logo-img {
            width: 90px;
            height: 90px;
            object-fit: contain;
            filter: brightness(1.05);
            transition: all 0.3s ease;
        }

        .footer-logo-img:hover {
            filter: brightness(1.2);
            transform: scale(1.05);
        }

        .footer-branding {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .footer-title {
            font-size: 1.3rem;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #fff;
        }

        .footer-title span {
            color: var(--color-gold);
        }

        .footer-tagline {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.5);
            line-height: 1.6;
            letter-spacing: 0.5px;
            max-width: 250px;
        }

        /* Footer Grid Section */
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-col {
            display: flex;
            flex-direction: column;
        }

        .footer-col-title {
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--color-gold);
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.8rem;
        }

        .footer-col-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 1px;
            background: var(--color-gold);
            opacity: 0.5;
        }

        .footer-col a,
        .footer-col span {
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            font-size: 0.8rem;
            letter-spacing: 0.3px;
            margin-bottom: 0.9rem;
            transition: all 0.2s ease;
            display: inline-block;
            line-height: 1.5;
        }

        .footer-col a:hover {
            color: var(--color-gold);
            transform: translateX(3px);
        }

        .footer-col span {
            display: block;
            cursor: default;
        }

        .footer-col span:hover {
            transform: none;
        }

        /* Footer Bottom */
        .footer-bottom-line {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .footer-copy {
            font-size: 0.7rem;
            letter-spacing: 0.5px;
            color: rgba(255, 255, 255, 0.35);
        }

        /* ── FIX CONTAINER ── */
        .container {
            width: 100%;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 2rem;
            padding-right: 2rem;
        }

        .container-fluid {
            width: 100%;
            padding-left: 0;
            padding-right: 0;
        }

        /* ── FIX BOOTSTRAP GRID ── */
        .row {
            margin-left: 0;
            margin-right: 0;
        }

        /* ── RESPONSIVE NAVBAR ── */
        @media (max-width: 1024px) {
            .trp-nav-links {
                display: none;
            }

            .auth-section {
                display: none;
            }

            .btn-reservar-nav {
                display: none;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .trp-logo {
                font-size: 0.85rem;
                letter-spacing: 1.5px;
            }

            .trp-logo-img {
                width: 35px;
                height: 35px;
            }
        }

        @media (max-width: 768px) {
            .trp-navbar {
                padding: 0 1rem;
                height: 60px;
            }

            .footer-header {
                flex-direction: column;
                gap: 1.5rem;
                padding-bottom: 2rem;
                margin-bottom: 2.5rem;
            }

            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 2rem;
            }

            .footer-brand-group {
                min-width: auto;
            }

            .footer-logo-img {
                width: 70px;
                height: 70px;
            }

            .footer-title {
                font-size: 1.1rem;
            }

            .footer-tagline {
                font-size: 0.75rem;
                max-width: 100%;
            }

            .footer-col-title {
                margin-bottom: 1rem;
                font-size: 0.65rem;
            }

            .footer-col a,
            .footer-col span {
                font-size: 0.75rem;
                margin-bottom: 0.7rem;
            }

            .footer-bottom-line {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .footer-copy {
                width: 100%;
            }

            .mobile-menu {
                padding: 1.5rem;
                top: 60px;
            }

            .mobile-menu-item {
                padding: 0.75rem 0;
            }

            .mobile-menu-footer {
                padding-top: 1rem;
                margin-top: 1rem;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="trp-navbar" id="trpNavbar">
        <!-- Logo Section -->
        <a href="{{ route('home') }}" class="trp-logo-section">
            <img src="{{ asset('images/logo.png') }}" alt="The Royale Palace" class="trp-logo-img">
            <span class="trp-logo">The <span>Royale</span> Palace</span>
        </a>

        <!-- Center Navigation -->
        <ul class="trp-nav-links d-none d-lg-flex">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Inicio</a></li>
            <li><a href="{{ route('menu.index') }}" class="{{ request()->routeIs('menu.*') ? 'active' : '' }}">Menú</a>
            </li>
            <li><a href="{{ route('reservaciones.create') }}"
                    class="{{ request()->routeIs('reservaciones.*') ? 'active' : '' }}">Reservaciones</a></li>

            <!-- Dropdown Sedes/Sucursales -->
            <li class="nav-dropdown" id="sedesDropdown">
                <a href="#" class="nav-dropdown-toggle"
                    onclick="event.preventDefault(); toggleDropdown('sedesDropdown')">
                    Sedes
                    <i class="bi bi-chevron-down nav-dropdown-icon"></i>
                </a>
                <div class="nav-dropdown-menu">
                    <a href="{{ route('menu.sede', 'san-salvador') }}">
                        <i class="bi bi-geo-alt-fill"></i>San Salvador
                    </a>
                    <a href="{{ route('menu.sede', 'santa-ana') }}">
                        <i class="bi bi-geo-alt-fill"></i>Santa Ana
                    </a>
                    <a href="{{ route('menu.sede', 'san-miguel') }}">
                        <i class="bi bi-geo-alt-fill"></i>San Miguel
                    </a>
                </div>
            </li>

            <li><a href="{{ route('nosotros') }}"
                    class="{{ request()->routeIs('nosotros') ? 'active' : '' }}">Nosotros</a></li>
            <li><a href="{{ route('contacto') }}"
                    class="{{ request()->routeIs('contacto') ? 'active' : '' }}">Contacto</a></li>
        </ul>

        <!-- Right Section -->
        <div class="trp-nav-right d-none d-lg-flex">
            @auth
                <div class="auth-section">
                    <a href="{{ route('cuenta.index') }}" title="Mi Cuenta">
                        <i class="bi bi-person-circle"></i>Mi Cuenta
                    </a>
                    @if(Auth::user()->hasAnyRole(['super_admin', 'admin_san_salvador', 'admin_santa_ana', 'admin_san_miguel']))
                        <a href="{{ route('admin.dashboard') }}" title="Panel Admin">
                            Admin <span class="admin-badge">ADMIN</span>
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button type="submit" class="logout-btn" title="Cerrar sesión">
                            <i class="bi bi-box-arrow-right"></i>Salir
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}"
                    style="padding: 12px 14px; color: var(--color-dark); font-size: 0.7rem; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; text-decoration: none; display: flex; align-items: center; gap: 6px;">
                    <i class="bi bi-box-arrow-in-right"></i>Iniciar sesión
                </a>

                @auth
                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}"
                            style="position:fixed;bottom:20px;right:20px;z-index:1000;
                                                                              background:#1a1a2e;width:50px;height:50px;border-radius:50%;
                                                                              display:flex;align-items:center;justify-content:center;
                                                                              border:2px solid var(--color-gold);text-decoration:none;" title="Panel Administrador">
                            <i class="bi bi-shield-shaded" style="color:var(--color-gold);font-size:1.3rem;"></i>
                        </a>
                    @endif
                @endauth


















            @endauth



            <a href="{{ route('reservaciones.create') }}" class="btn-reservar-nav">
                <i class="bi bi-calendar-check"></i>Reservar
            </a>
        </div>

        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-toggle" id="mobileMenuToggle" onclick="toggleMobileMenu()">
            <i class="bi bi-list"></i>
        </button>
    </nav>

    {{-- MOBILE MENU --}}
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-item">
            <a href="{{ route('home') }}" onclick="closeMobileMenu()">
                <i class="bi bi-house-fill"></i> Inicio
            </a>
        </div>

        <div class="mobile-menu-item">
            <a href="{{ route('menu.index') }}" onclick="closeMobileMenu()">
                <i class="bi bi-book-half"></i> Menú
            </a>
        </div>

        <div class="mobile-menu-item">
            <a href="{{ route('reservaciones.create') }}" onclick="closeMobileMenu()">
                <i class="bi bi-calendar-check"></i> Reservaciones
            </a>
        </div>

        <div class="mobile-menu-item">
            <button onclick="toggleMobileSubmenu('sedesSubmenu')">
                <i class="bi bi-geo-alt-fill"></i> Sedes
                <i class="bi bi-chevron-down" style="margin-left: auto;"></i>
            </button>
            <div class="mobile-submenu" id="sedesSubmenu">
                <a href="{{ route('menu.sede', 'san-salvador') }}" onclick="closeMobileMenu()">San Salvador</a>
                <a href="{{ route('menu.sede', 'santa-ana') }}" onclick="closeMobileMenu()">Santa Ana</a>
                <a href="{{ route('menu.sede', 'san-miguel') }}" onclick="closeMobileMenu()">San Miguel</a>
            </div>
        </div>

        <div class="mobile-menu-item">
            <a href="{{ route('nosotros') }}" onclick="closeMobileMenu()">
                <i class="bi bi-people-fill"></i> Nosotros
            </a>
        </div>

        <div class="mobile-menu-item">
            <a href="{{ route('contacto') }}" onclick="closeMobileMenu()">
                <i class="bi bi-telephone-fill"></i> Contacto
            </a>
        </div>

        <div class="mobile-menu-footer">
            @auth
                <a href="{{ route('cuenta.index') }}" onclick="closeMobileMenu()"
                    style="background: var(--color-bg-soft); color: var(--color-dark);">
                    <i class="bi bi-person-circle"></i> Mi Cuenta
                </a>
                @if(Auth::user()->hasAnyRole(['super_admin', 'admin_san_salvador', 'admin_santa_ana', 'admin_san_miguel']))
                    <a href="{{ route('admin.dashboard') }}" onclick="closeMobileMenu()"
                        style="background: var(--color-bg-soft); color: var(--color-dark);">
                        <i class="bi bi-gear-fill"></i> Panel Admin
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        style="width: 100%; background: var(--color-bg-soft); color: var(--color-dark); padding: 12px;">
                        <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" onclick="closeMobileMenu()" class="btn-login">
                    <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                </a>
            @endauth
            <a href="{{ route('reservaciones.create') }}" onclick="closeMobileMenu()" class="btn-reservar">
                <i class="bi bi-calendar-check"></i> Reservar Mesa
            </a>
        </div>
    </div>

    {{-- CONTENIDO --}}
    <main style="padding-top: 70px;">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="trp-footer">
        <div class="container">
            <!-- Footer Header: Logo y Tagline -->
            <div class="footer-header">
                <div class="footer-brand-group">
                    <img src="{{ asset('images/logo-b.png') }}" alt="The Royale Palace" class="footer-logo-img">
                    <div class="footer-branding">
                        <div class="footer-title">
                            The <span>Royale</span> Palace
                        </div>
                        <p class="footer-tagline">
                            Sabores auténticos de El Salvador, elevados a una experiencia premium.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Footer Content Grid -->
            <div class="footer-grid">
                <!-- Navegación -->
                <div class="footer-col">
                    <h3 class="footer-col-title">Navegación</h3>
                    <a href="{{ route('menu.index') }}">Menú</a>
                    <a href="{{ route('reservaciones.create') }}">Reservaciones</a>
                    <a href="{{ route('sucursales') }}">Sucursales</a>
                    <a href="{{ route('nosotros') }}">Nosotros</a>
                    <a href="{{ route('contacto') }}">Contacto</a>
                </div>

                <!-- Sedes -->
                <div class="footer-col">
                    <h3 class="footer-col-title">Sedes</h3>
                    <a href="{{ route('menu.sede', 'san-salvador') }}">San Salvador</a>
                    <a href="{{ route('menu.sede', 'santa-ana') }}">Santa Ana</a>
                    <a href="{{ route('menu.sede', 'san-miguel') }}">San Miguel</a>
                </div>

                <!-- Contacto -->
                <div class="footer-col">
                    <h3 class="footer-col-title">Contacto</h3>
                    <span>reservaciones@theroyalepalace.sv</span>
                    <span>+503 2200-0000</span>
                </div>

                <!-- Horarios -->
                <div class="footer-col">
                    <h3 class="footer-col-title">Horarios</h3>
                    <span>Lunes a Jueves<br>11:00 AM - 10:00 PM</span>
                    <span style="margin-top: 0.5rem;">Viernes a Domingo<br>11:00 AM - 11:00 PM</span>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom-line">
                <span class="footer-copy">© {{ date('Y') }} The Royale Palace. Todos los derechos reservados.</span>
                <span class="footer-copy">Hecho con orgullo en El Salvador 🇸🇻</span>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            document.getElementById('trpNavbar').classList.toggle('scrolled', window.scrollY > 20);
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            const dropdown = document.getElementById('sedesDropdown');
            if (dropdown && !dropdown.contains(event.target)) {
                dropdown.classList.remove('active');
            }
        });

        // Toggle dropdown function
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('active');
        }

        // Mobile menu functions
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('active');
        }

        function closeMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.remove('active');
        }

        function toggleMobileSubmenu(submenuId) {
            const submenu = document.getElementById(submenuId);
            submenu.classList.toggle('active');
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function (event) {
            const mobileMenu = document.getElementById('mobileMenu');
            const menuToggle = document.getElementById('mobileMenuToggle');

            if (mobileMenu && !mobileMenu.contains(event.target) && !menuToggle.contains(event.target)) {
                mobileMenu.classList.remove('active');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>