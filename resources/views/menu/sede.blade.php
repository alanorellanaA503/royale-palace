@extends('layouts.app')

@section('title', 'Menú ' . $sede->nombre . ' — The Royale Palace')

@push('styles')
    <style>
        /* ── VARIABLES GLOBALES ── */
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

        /* ── ESTILO PREMIUM TIPO SWIGO ── */
        .plato-imagen-container {
            position: relative;
            width: 100%;
            aspect-ratio: 4 / 3;
            overflow: hidden;
            border-radius: 20px;
            margin-bottom: 1.25rem;
            background: linear-gradient(135deg, #f5f5f0 0%, #e8e4d8 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            cursor: pointer;
        }

        .plato-imagen {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* Hover con zoom premium */
        .plato-card-menu:hover .plato-imagen {
            transform: scale(1.08);
            filter: brightness(1.05) contrast(1.02);
        }

        /* Overlay sutil al hover */
        .plato-imagen-container::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                    rgba(200, 162, 77, 0.1) 0%,
                    transparent 60%);
            opacity: 0;
            transition: opacity 0.4s ease;
            pointer-events: none;
            border-radius: 20px;
        }

        .plato-card-menu:hover .plato-imagen-container::after {
            opacity: 1;
        }

        /* Placeholder elegante */
        .plato-imagen-container.placeholder {
            background: linear-gradient(135deg, #2a2a2a 0%, #1a1a1a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .plato-imagen-container.placeholder i {
            font-size: 3rem;
            color: var(--color-gold);
            opacity: 0.35;
            transition: all 0.3s ease;
        }

        .plato-card-menu:hover .plato-imagen-container.placeholder i {
            opacity: 0.6;
            transform: scale(1.05);
        }

        /* ── SEDE HERO ────────────────────────────────── */
        .sede-menu-hero {
            padding: 100px 0 60px;
            background: linear-gradient(135deg, var(--color-bg-soft) 0%, var(--color-bg) 100%);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .sede-menu-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(200, 162, 77, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .sede-menu-hero::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(48, 93, 66, 0.03) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .sede-menu-hero-content {
            position: relative;
            z-index: 1;
            animation: fadeInDown 0.8s ease forwards;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .sede-menu-hero .section-label {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--color-gold);
            margin-bottom: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .sede-menu-hero .section-title {
            font-size: clamp(2rem, 6vw, 3.5rem);
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--color-dark);
            line-height: 1.1;
            margin-bottom: 1rem;
        }

        .sede-menu-hero .gold-divider {
            margin: 1rem auto 1.5rem;
            animation: expandWidth 0.8s ease 0.2s forwards;
            transform-origin: center;
            opacity: 0;
        }

        @keyframes expandWidth {
            from {
                opacity: 0;
                width: 0;
            }

            to {
                opacity: 1;
                width: 50px;
            }
        }

        .sede-menu-hero .section-subtitle {
            font-size: 0.9rem;
            font-weight: 400;
            color: var(--color-muted);
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto;
        }

        /* ── TABS MEJORADOS ───────────────────────────── */
        .menu-tabs-wrapper {
            display: flex;
            gap: 2rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 3rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--color-line);
            overflow-x: auto;
        }

        .menu-tab {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-muted);
            text-decoration: none;
            padding: 8px 0;
            border-bottom: 2.5px solid transparent;
            transition: all 0.3s ease;
            cursor: pointer;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .menu-tab.active {
            color: var(--color-gold);
            border-bottom-color: var(--color-gold);
        }

        .menu-tab:hover {
            color: var(--color-gold);
            border-bottom-color: rgba(200, 162, 77, 0.3);
        }

        .menu-tab i {
            font-size: 0.9rem;
            transition: transform 0.3s ease;
        }

        .menu-tab:hover i {
            transform: scale(1.15);
        }

        /* ── CATEGORÍA HEADER ─────────────────────────── */
        .categoria-section {
            margin-bottom: 3.5rem;
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .categoria-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--color-line);
        }

        .categoria-icon {
            font-size: 1.3rem;
            color: var(--color-gold);
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 32px;
            height: 32px;
            background: rgba(200, 162, 77, 0.08);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .categoria-header:hover .categoria-icon {
            background: rgba(200, 162, 77, 0.15);
            transform: scale(1.05);
        }

        .categoria-title {
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--color-gold);
            margin: 0;
            flex: 1;
        }

        .categoria-count {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 1px;
            color: var(--color-muted);
            background: var(--color-bg-soft);
            padding: 4px 12px;
            border-radius: 20px;
        }

        /* ── PLATO CARD - 3 por fila ───────────────────── */
        .plato-card-menu {
            background: var(--color-bg);
            border: 1px solid var(--color-line);
            border-radius: 20px;
            padding: 1.5rem;
            height: 100%;
            transition: all 0.35s ease;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .plato-card-menu:hover {
            border-color: var(--color-gold);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transform: translateY(-6px);
        }

        /* Badges modernos */
        .plato-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.55rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 50px;
            width: fit-content;
        }

        .plato-badge-insignia {
            background: rgba(200, 162, 77, 0.12);
            color: #b8860b;
        }

        .plato-badge-temporada {
            background: rgba(48, 93, 66, 0.12);
            color: #2d6a4f;
        }

        .plato-nombre {
            font-size: 1rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--color-dark);
            margin-bottom: 0.6rem;
            line-height: 1.3;
            transition: color 0.2s ease;
        }

        .plato-card-menu:hover .plato-nombre {
            color: var(--color-gold);
        }

        .plato-descripcion {
            font-size: 0.8rem;
            color: var(--color-muted);
            line-height: 1.6;
            margin-bottom: 1.25rem;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .plato-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid var(--color-line);
            gap: 1rem;
        }

        .plato-precio {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--color-gold);
            display: flex;
            align-items: baseline;
            gap: 2px;
        }

        .plato-precio-signo {
            font-size: 0.85rem;
        }

        .favorito-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
            color: var(--color-muted);
            transition: all 0.2s ease;
            padding: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .favorito-btn:hover {
            color: var(--color-gold);
            transform: scale(1.15);
            background: rgba(200, 162, 77, 0.1);
        }

        .favorito-btn.active {
            color: #e74c3c;
        }

        /* ── EMPTY STATE ──────────────────────────────── */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            background: var(--color-bg-soft);
            border-radius: 16px;
            margin: 2rem 0;
        }

        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }

        .empty-state-text {
            font-size: 0.9rem;
            color: var(--color-muted);
            margin: 0;
        }

        /* ── RESPONSIVE GRID (3 → 2 → 1) ── */
        /* Desktop: 3 columnas */
        .row.g-4 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        /* Tablet: 2 columnas */
        @media (max-width: 992px) {
            .row.g-4 {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.25rem;
            }
        }

        /* Móvil: 1 columna */
        @media (max-width: 576px) {
            .row.g-4 {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .plato-card-menu {
                padding: 1.25rem;
            }
        }

        /* Ajustes adicionales responsive */
        @media (max-width: 768px) {
            .sede-menu-hero {
                padding: 60px 0 40px;
            }

            .sede-menu-hero .section-title {
                font-size: 1.8rem;
            }

            .menu-tabs-wrapper {
                gap: 1rem;
                margin-bottom: 2rem;
            }

            .menu-tab {
                font-size: 0.6rem;
                padding: 6px 0;
                gap: 5px;
            }

            .menu-tab i {
                font-size: 0.75rem;
            }

            .categoria-header {
                margin-bottom: 1.5rem;
                padding-bottom: 0.75rem;
            }

            .categoria-count {
                display: none;
            }

            .plato-nombre {
                font-size: 0.9rem;
            }

            .plato-descripcion {
                font-size: 0.75rem;
                -webkit-line-clamp: 2;
            }

            .plato-precio {
                font-size: 1rem;
            }

            .plato-imagen-container {
                border-radius: 16px;
            }
        }

        /* Ajustes para pantallas muy pequeñas */
        @media (max-width: 480px) {
            .plato-imagen-container {
                border-radius: 14px;
            }

            .plato-card-menu {
                padding: 1rem;
            }

            .plato-badge {
                font-size: 0.5rem;
                padding: 4px 10px;
            }
        }
    </style>
@endpush

@section('content')

    {{-- ═══════════════════ SEDE HERO ═══════════════════ --}}
    <section class="sede-menu-hero">
        <div class="container">
            <div class="sede-menu-hero-content">
                <p class="section-label">
                    <i class="bi bi-geo-alt-fill"></i>Zona {{ $sede->zona }}
                </p>
                <h1 class="section-title">{{ strtoupper($sede->nombre) }}</h1>
                <div class="gold-divider mx-auto"></div>
                <p class="section-subtitle">
                    Descubre nuestros platillos exclusivos de la región.<br>
                    Ingredientes frescos seleccionados especialmente para esta sede.
                </p>
            </div>
        </div>
    </section>

    {{-- ═══════════════════ CONTENIDO MENÚ ═══════════════════ --}}
    <section style="padding: 60px 0 80px; background: var(--color-bg); position: relative;">
        <div class="container" style="position: relative; z-index: 1;">

            {{-- Tabs de categorías --}}
            <div class="menu-tabs-wrapper" id="menuTabs">
                <a href="#todos" class="menu-tab active" onclick="scrollToSection('todos')">
                    <i class="bi bi-grid-3x3-gap-fill"></i>Todos
                </a>
                @php
                    $categoryIcons = [
                        'Entradas' => 'bi-egg-fried',
                        'Platillos Principales' => 'bi-fire',
                        'Postres' => 'bi-cake2',
                        'Bebidas' => 'bi-cup-straw',
                        'Sopas' => 'bi-cup',
                        'Ensaladas' => 'bi-leaf',
                        'Mariscos' => 'bi-water',
                        'Carnes' => 'bi-bezier2',
                        'Vegetarianos' => 'bi-flower2',
                    ];
                @endphp
                @foreach($categorias as $cat)
                    @if(isset($platos[$cat->nombre]) && count($platos[$cat->nombre]) > 0)
                        <a href="#{{ Str::slug($cat->nombre) }}" class="menu-tab"
                            onclick="scrollToSection('{{ Str::slug($cat->nombre) }}')">
                            <i class="bi {{ $categoryIcons[$cat->nombre] ?? 'bi-dish' }}"></i>{{ $cat->nombre }}
                        </a>
                    @endif
                @endforeach
            </div>

            {{-- Platos agrupados por categoría --}}
            <div id="todos">
                @forelse($platos as $categoria => $items)
                    <div id="{{ Str::slug($categoria) }}" class="categoria-section"
                        style="animation-delay: {{ $loop->index * 0.1 }}s;">
                        <div class="categoria-header">
                            <div class="categoria-icon">
                                <i class="bi {{ $categoryIcons[$categoria] ?? 'bi-dish' }}"></i>
                            </div>
                            <h2 class="categoria-title">{{ $categoria }}</h2>
                            <span class="categoria-count">{{ count($items) }} platos</span>
                        </div>

                        <div class="row g-4">
                            @foreach($items as $plato)
                                <div class="col">
                                    <div class="plato-card-menu">
                                        {{-- Badges --}}
                                        <div style="display: flex; gap: 0.5rem; margin-bottom: 1rem; flex-wrap: wrap;">
                                            @if($plato->es_insignia)
                                                <span class="plato-badge plato-badge-insignia">
                                                    <i class="bi bi-award-fill"></i> Insignia
                                                </span>
                                            @endif
                                            @if($plato->es_temporada)
                                                <span class="plato-badge plato-badge-temporada">
                                                    <i class="bi bi-leaf"></i> Temporada
                                                </span>
                                            @endif
                                        </div>

                                        {{-- Imagen del plato (aspect ratio 4:3) --}}
                                        <div class="plato-imagen-container {{ !$plato->imagen ? 'placeholder' : '' }}">
                                            @if($plato->imagen)
                                                <img src="{{ asset('images/platos/' . $plato->imagen) }}" alt="{{ $plato->nombre }}"
                                                    class="plato-imagen" loading="lazy">
                                            @else
                                                <i class="bi bi-image"></i>
                                            @endif
                                        </div>

                                        {{-- Nombre y descripción --}}
                                        <h3 class="plato-nombre">{{ $plato->nombre }}</h3>
                                        <p class="plato-descripcion">{{ Str::limit($plato->descripcion, 100) }}</p>

                                        {{-- Footer con precio y favorito --}}
                                        <div class="plato-footer">
                                            <span class="plato-precio">
                                                <span class="plato-precio-signo">$</span>{{ number_format($plato->precio, 2) }}
                                            </span>
                                            @auth
                                                <form method="POST" action="{{ route('favoritos.toggle', $plato) }}"
                                                    style="display: inline;">
                                                    @csrf
                                                    <button type="submit"
                                                        class="favorito-btn {{ auth()->user()->favoritos()->where('plato_id', $plato->id)->exists() ? 'active' : '' }}"
                                                        title="{{ auth()->user()->favoritos()->where('plato_id', $plato->id)->exists() ? 'Quitar de favoritos' : 'Agregar a favoritos' }}">
                                                        <i
                                                            class="bi {{ auth()->user()->favoritos()->where('plato_id', $plato->id)->exists() ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <a href="{{ route('login') }}" class="favorito-btn"
                                                    title="Inicia sesión para guardar favoritos">
                                                    <i class="bi bi-heart"></i>
                                                </a>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="bi bi-inbox"></i>
                        </div>
                        <p class="empty-state-text">No hay platillos disponibles en esta sede por el momento.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    {{-- ═══════════════════ CTA FINAL ══════════════════ --}}
    <section
        style="padding: 60px 0; background: linear-gradient(135deg, var(--color-dark) 0%, #1a1a1a 100%); text-align: center; position: relative; overflow: hidden;">
        <div class="container" style="position: relative; z-index: 1;">
            <div style="opacity: 0; animation: fadeInUp 0.6s ease forwards;">
                <p class="section-label" style="color: rgba(255, 255, 255, 0.35); font-size: 0.75rem;">
                    <i class="bi bi-calendar-check"></i> Próximo Paso
                </p>
                <h2 class="section-title" style="color: #fff; font-size: clamp(1.6rem, 4vw, 2.5rem);">
                    ¿Listo para Probar?
                </h2>
                <div class="gold-divider mx-auto" style="margin: 1rem auto 1.5rem;"></div>
                <p
                    style="color: rgba(255, 255, 255, 0.5); font-size: 0.85rem; max-width: 500px; margin: 0 auto 2rem; line-height: 1.7;">
                    Reserva tu mesa en {{ $sede->nombre }} y vive una experiencia gastronómica única.
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('reservaciones.create', ['sede' => $sede->slug]) }}" class="btn-gold"
                        style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 28px;">
                        <i class="bi bi-calendar-check"></i> Reservar Mesa
                    </a>
                    <a href="{{ route('menu.index') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 28px; 
                                       background: transparent; color: rgba(255, 255, 255, 0.6); 
                                       font-size: 0.65rem; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; 
                                       text-decoration: none; border: 1.5px solid rgba(255, 255, 255, 0.15); 
                                       border-radius: 4px; transition: all 0.25s;"
                        onmouseover="this.style.borderColor='var(--color-gold)';this.style.color='var(--color-gold)'"
                        onmouseout="this.style.borderColor='rgba(255,255,255,0.15)';this.style.color='rgba(255,255,255,0.6)'">
                        <i class="bi bi-arrow-left"></i> Otros Menús
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        // Scroll suave a secciones
        function scrollToSection(sectionId) {
            const element = document.getElementById(sectionId);
            if (element) {
                const tabs = document.querySelectorAll('.menu-tab');
                tabs.forEach(tab => tab.classList.remove('active'));

                const activeTab = document.querySelector(`[href="#${sectionId}"]`);
                if (activeTab) activeTab.classList.add('active');

                element.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        // Actualizar tab activo al hacer scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const sectionId = entry.target.id;
                    const tabs = document.querySelectorAll('.menu-tab');
                    tabs.forEach(tab => tab.classList.remove('active'));

                    const activeTab = document.querySelector(`[href="#${sectionId}"]`);
                    if (activeTab) activeTab.classList.add('active');
                }
            });
        }, { threshold: 0.3 });

        document.querySelectorAll('.categoria-section').forEach(section => observer.observe(section));
    </script>
@endpush