<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — The Royale Palace</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --color-gold: #C8A24D;
            --color-gold-hover: #A8862C;
            --color-green: #305D42;
            --color-dark: #111111;
            --color-muted: #555555;
            --color-line: #E5E5E5;
            --color-bg: #FFFFFF;
            --color-bg-soft: #F8F8F8;
            --sidebar-w: 260px;
            --font-main: 'Montserrat', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-main);
            background: #F4F5F7;
            color: var(--color-dark);
            display: flex;
            min-height: 100vh;
        }

        /* ── SIDEBAR ── */
        .admin-sidebar {
            width: var(--sidebar-w);
            background: var(--color-dark);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform 0.3s ease;
        }

        .sidebar-brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        .sidebar-brand-logo {
            width: 36px;
            height: 36px;
            object-fit: contain;
        }

        .sidebar-brand-text {
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #fff;
            line-height: 1.3;
        }

        .sidebar-brand-text span {
            color: var(--color-gold);
        }

        .sidebar-badge {
            margin-left: auto;
            font-size: 0.5rem;
            font-weight: 700;
            letter-spacing: 1px;
            background: var(--color-gold);
            color: #fff;
            padding: 3px 8px;
            border-radius: 20px;
            text-transform: uppercase;
        }

        /* Nav groups */
        .sidebar-nav {
            flex: 1;
            padding: 1.5rem 0;
            overflow-y: auto;
        }

        .nav-group-label {
            font-size: 0.55rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.25);
            padding: 0 1.5rem;
            margin-bottom: 0.5rem;
            margin-top: 1.5rem;
        }

        .nav-group-label:first-child {
            margin-top: 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 1.5rem;
            color: rgba(255, 255, 255, 0.55);
            text-decoration: none;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.2s ease;
            position: relative;
            border-left: 3px solid transparent;
        }

        .nav-item:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.05);
        }

        .nav-item.active {
            color: var(--color-gold);
            background: rgba(200, 162, 77, 0.08);
            border-left-color: var(--color-gold);
        }

        .nav-item i {
            font-size: 1rem;
            width: 18px;
            text-align: center;
        }

        .nav-badge {
            margin-left: auto;
            font-size: 0.55rem;
            font-weight: 700;
            background: var(--color-gold);
            color: #fff;
            padding: 2px 7px;
            border-radius: 10px;
        }

        /* Sidebar footer */
        .sidebar-footer {
            padding: 1.25rem 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .sidebar-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--color-gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 800;
            color: #fff;
            flex-shrink: 0;
        }

        .sidebar-user-info {
            overflow: hidden;
        }

        .sidebar-user-name {
            font-size: 0.72rem;
            font-weight: 700;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-user-role {
            font-size: 0.6rem;
            color: var(--color-gold);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 6px;
            width: 100%;
            padding: 9px 12px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            color: rgba(255, 255, 255, 0.5);
            font-family: var(--font-main);
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-logout:hover {
            background: rgba(229, 57, 53, 0.15);
            color: #EF9A9A;
            border-color: rgba(229, 57, 53, 0.3);
        }

        /* ── MAIN CONTENT ── */
        .admin-main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Topbar */
        .admin-topbar {
            background: var(--color-bg);
            border-bottom: 1px solid var(--color-line);
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-title {
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .topbar-title i {
            color: var(--color-gold);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .topbar-sede {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-muted);
            background: var(--color-bg-soft);
            border: 1px solid var(--color-line);
            padding: 6px 14px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .topbar-sede i {
            color: var(--color-gold);
        }

        .topbar-link {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--color-muted);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: color 0.2s;
        }

        .topbar-link:hover {
            color: var(--color-gold);
        }

        /* Content area */
        .admin-content {
            padding: 2rem;
            flex: 1;
        }

        /* ── WIDGETS ── */
        .widget-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .widget-card {
            background: var(--color-bg);
            border: 1px solid var(--color-line);
            border-radius: 12px;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .widget-card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.07);
            transform: translateY(-2px);
        }

        .widget-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--color-gold);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.35s ease;
        }

        .widget-card:hover::before {
            transform: scaleX(1);
        }

        .widget-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: rgba(200, 162, 77, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--color-gold);
            margin-bottom: 1rem;
        }

        .widget-value {
            font-size: 2rem;
            font-weight: 800;
            color: var(--color-dark);
            line-height: 1;
            margin-bottom: 0.25rem;
        }

        .widget-label {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-muted);
        }

        /* ── CONTENT CARDS ── */
        .content-card {
            background: var(--color-bg);
            border: 1px solid var(--color-line);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .content-card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--color-line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .content-card-title {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-dark);
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
        }

        .content-card-title i {
            color: var(--color-gold);
        }

        .content-card-body {
            padding: 1.5rem;
        }

        /* ── TABLA ADMIN ── */
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.82rem;
        }

        .admin-table th {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-muted);
            padding: 0.75rem 1rem;
            border-bottom: 2px solid var(--color-line);
            text-align: left;
            white-space: nowrap;
        }

        .admin-table td {
            padding: 0.875rem 1rem;
            border-bottom: 1px solid var(--color-line);
            color: var(--color-dark);
            vertical-align: middle;
        }

        .admin-table tr:last-child td {
            border-bottom: none;
        }

        .admin-table tr:hover td {
            background: var(--color-bg-soft);
        }

        /* ── BADGES ── */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .badge-green {
            background: rgba(48, 93, 66, 0.1);
            color: #305D42;
        }

        .badge-gold {
            background: rgba(200, 162, 77, 0.1);
            color: #A8862C;
        }

        .badge-red {
            background: rgba(229, 57, 53, 0.1);
            color: #C62828;
        }

        .badge-gray {
            background: rgba(0, 0, 0, 0.05);
            color: var(--color-muted);
        }

        /* ── BOTONES ── */
        .btn-admin {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 18px;
            font-family: var(--font-main);
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-admin-gold {
            background: var(--color-gold);
            color: #fff;
        }

        .btn-admin-gold:hover {
            background: var(--color-gold-hover);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-admin-outline {
            background: transparent;
            color: var(--color-muted);
            border: 1px solid var(--color-line);
        }

        .btn-admin-outline:hover {
            border-color: var(--color-gold);
            color: var(--color-gold);
        }

        .btn-admin-danger {
            background: rgba(229, 57, 53, 0.1);
            color: #C62828;
            border: 1px solid rgba(229, 57, 53, 0.2);
        }

        .btn-admin-danger:hover {
            background: #C62828;
            color: #fff;
        }

        .btn-admin-sm {
            padding: 6px 12px;
            font-size: 0.6rem;
        }

        /* ── FORM ADMIN ── */
        .form-group-admin {
            margin-bottom: 1.25rem;
        }

        .form-label-admin {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-muted);
            margin-bottom: 0.6rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-control-admin {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid var(--color-line);
            background: var(--color-bg-soft);
            font-family: var(--font-main);
            font-size: 0.85rem;
            color: var(--color-dark);
            outline: none;
            transition: all 0.2s ease;
            border-radius: 6px;
            appearance: none;
        }

        .form-control-admin:focus {
            border-color: var(--color-gold);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(200, 162, 77, 0.1);
        }

        /* Alerts */
        .alert-admin {
            padding: 0.875rem 1.25rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
        }

        .alert-success-admin {
            background: #E8F5E9;
            color: #2E7D32;
            border-left: 4px solid #305D42;
        }

        .alert-error-admin {
            background: #FDECEA;
            color: #C62828;
            border-left: 4px solid #E53935;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.open {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
            }
        }
    </style>
    @stack('styles')
</head>

<body>

    {{-- SIDEBAR --}}
    <aside class="admin-sidebar" id="adminSidebar">
        <a href="{{ route('home') }}" class="sidebar-brand">
            <img src="{{ asset('images/logo-b.png') }}" class="sidebar-brand-logo" alt="TRP"
                onerror="this.style.display='none'">
            <div>
                <div class="sidebar-brand-text">The <span>Royale</span><br>Palace</div>
            </div>
            <span class="sidebar-badge">Admin</span>
        </a>

        <nav class="sidebar-nav">
            <p class="nav-group-label">Principal</p>
            <a href="{{ route('admin.dashboard') }}"
                class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <p class="nav-group-label">Reservaciones</p>
            <a href="{{ route('admin.reservaciones.index') }}"
                class="nav-item {{ request()->routeIs('admin.reservaciones.*') ? 'active' : '' }}">
                <i class="bi bi-calendar-check"></i> Reservaciones
            </a>

            <p class="nav-group-label">Gestión de Contenido</p>
            <a href="{{ route('admin.platos.index') }}"
                class="nav-item {{ request()->routeIs('admin.platos.*') ? 'active' : '' }}">
                <i class="bi bi-egg-fried"></i> Platillos y Bebidas
            </a>
            <a href="{{ route('admin.mesas.index') }}"
                class="nav-item {{ request()->routeIs('admin.mesas.*') ? 'active' : '' }}">
                <i class="bi bi-table"></i> Mesas
            </a>
            <a href="{{ route('admin.usuarios.index') }}"
                class="nav-item {{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Usuarios
            </a>

            <p class="nav-group-label">Reportes</p>
            <a href="{{ route('admin.reservaciones.reporte') }}" class="nav-item" target="_blank">
                <i class="bi bi-file-earmark-pdf"></i> Reporte PDF
            </a>

            <p class="nav-group-label">Sistema</p>
            <a href="{{ route('home') }}" class="nav-item" target="_blank">
                <i class="bi bi-globe"></i> Ver Sitio Web
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="sidebar-user-info">
                    <div class="sidebar-user-name">{{ Auth::user()->name }}</div>
                    <div class="sidebar-user-role" style="color:var(--color-gold);">
                        Administrador General
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-left"></i> Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="admin-main">
        <header class="admin-topbar">
            <div class="topbar-title">
                <i class="bi bi-@yield('topbar-icon', 'speedometer2')"></i>
                @yield('topbar-title', 'Dashboard')
            </div>
            <div class="topbar-right">
                @if(Auth::user()->sede)
                    <span class="topbar-sede">
                        <i class="bi bi-geo-alt-fill"></i>
                        {{ Auth::user()->sede->nombre }}
                    </span>
                @endif
                <a href="{{ route('home') }}" class="topbar-link">
                    <i class="bi bi-globe"></i> Sitio Web
                </a>
            </div>
        </header>

        <main class="admin-content">
            @if(session('success'))
                <div class="alert-admin alert-success-admin">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert-admin alert-error-admin">
                    <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>

</html>