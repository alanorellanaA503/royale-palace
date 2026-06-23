@extends('layouts.app')

@section('title', 'Menú — The Royale Palace')

@push('styles')
    <style>
        /* ── MENU HERO ────────────────────────────────── */
        .menu-hero {
            padding: 100px 0 80px;
            background: linear-gradient(135deg, var(--color-bg-soft) 0%, var(--color-bg) 100%);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .menu-hero::before {
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

        .menu-hero::after {
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

        .menu-hero-content {
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

        .menu-hero .section-label {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--color-gold);
            margin-bottom: 1rem;
            display: block;
        }

        .menu-hero .section-title {
            font-size: clamp(2rem, 6vw, 3.5rem);
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--color-dark);
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }

        .menu-hero .gold-divider {
            margin: 1.5rem auto 2rem;
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

        .menu-hero .section-subtitle {
            font-size: 0.95rem;
            font-weight: 400;
            color: var(--color-muted);
            line-height: 1.8;
            max-width: 580px;
            margin: 0 auto 2rem;
        }

        /* ── SEDE CARDS ───────────────────────────────── */
        .sedes-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 0;
        }

        .sede-menu-card {
            display: flex;
            flex-direction: column;
            background: var(--color-bg);
            border: 1px solid var(--color-line);
            border-radius: 12px;
            overflow: hidden;
            text-decoration: none;
            transition: all 0.35s ease;
            position: relative;
            height: 100%;
            group: 'sede-menu';
        }

        .sede-menu-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--color-gold);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.35s ease;
            z-index: 2;
        }

        .sede-menu-card:hover {
            border-color: var(--color-gold);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
            transform: translateY(-6px);
        }

        .sede-menu-card:hover::before {
            transform: scaleX(1);
        }

        .sede-menu-card-icon {
            padding: 2.5rem 2.5rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            min-height: 120px;
            background: linear-gradient(135deg, var(--color-bg-soft) 0%, rgba(200, 162, 77, 0.05) 100%);
            transition: all 0.3s ease;
        }

        .sede-menu-card:hover .sede-menu-card-icon {
            background: linear-gradient(135deg, rgba(200, 162, 77, 0.1) 0%, rgba(200, 162, 77, 0.08) 100%);
            transform: scale(1.05);
        }

        .sede-menu-card-content {
            padding: 2rem 2.5rem 2.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .sede-menu-card-zona {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--color-gold);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .sede-menu-card-nombre {
            font-size: 1.4rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--color-dark);
            margin-bottom: 0.5rem;
            line-height: 1.2;
            transition: color 0.3s ease;
        }

        .sede-menu-card:hover .sede-menu-card-nombre {
            color: var(--color-gold);
        }

        .sede-menu-card-divider {
            width: 30px;
            height: 1.5px;
            background: var(--color-gold);
            margin: 0.75rem 0 1rem;
            transition: width 0.3s ease;
        }

        .sede-menu-card:hover .sede-menu-card-divider {
            width: 50px;
        }

        .sede-menu-card-desc {
            font-size: 0.85rem;
            color: var(--color-muted);
            line-height: 1.7;
            margin-bottom: 1.5rem;
            flex: 1;
        }

        .sede-menu-card-cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-gold);
            text-decoration: none;
            transition: all 0.2s ease;
            padding-right: 0;
        }

        .sede-menu-card-cta i {
            transition: transform 0.3s ease;
        }

        .sede-menu-card:hover .sede-menu-card-cta {
            color: var(--color-gold-hover);
            padding-right: 4px;
        }

        .sede-menu-card:hover .sede-menu-card-cta i {
            transform: translateX(4px);
        }

        /* ── ZONA INDICATORS ──────────────────────────── */
        .zona-indicator {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 0;
        }

        .zona-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }

        .zona-occidente .zona-dot {
            background: #FF6B6B;
        }

        .zona-centro .zona-dot {
            background: #4ECDC4;
        }

        .zona-oriente .zona-dot {
            background: #45B7D1;
        }

        /* ── FADE IN ──────────────────────────────────── */
        .fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .menu-hero {
                padding: 60px 0 50px;
            }

            .menu-hero .section-title {
                font-size: 2rem;
            }

            .sedes-cards-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .sede-menu-card-content {
                padding: 1.5rem 2rem;
            }

            .sede-menu-card-icon {
                padding: 1.5rem 2rem;
                min-height: 100px;
            }
        }
    </style>
@endpush

@section('content')

    {{-- ═══════════════════ MENU HERO ═══════════════════ --}}
    <section class="menu-hero">
        <div class="container">
            <div class="menu-hero-content">
                <p class="section-label">Gastronomía Salvadoreña</p>
                <h1 class="section-title">Nuestro Menú</h1>
                <div class="gold-divider mx-auto"></div>
                <p class="section-subtitle">
                    Selecciona una sede para explorar los platillos exclusivos de cada región.<br>
                    Ingredientes frescos, técnicas modernas y tradición en cada plato.
                </p>
            </div>
        </div>
    </section>

    {{-- ═══════════════════ SEDES MENÚ ═══════════════════ --}}
    <section style="padding: 100px 0; background: var(--color-bg-soft); position: relative;">
        <div
            style="position: absolute; top: -10%; right: -5%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(200, 162, 77, 0.04) 0%, transparent 70%); border-radius: 50%; pointer-events: none;">
        </div>

        <div class="container">
            <div class="sedes-cards-grid">
                @php
                    $sedeIcons = [
                        'san-salvador' => 'bi-building',
                        'santa-ana' => 'bi-sunset',
                        'san-miguel' => 'bi-water',
                    ];

                    $sedeDescripciones = [
                        'san-salvador' => 'Ubicado en el corazón de la capital. Experiencia gourmet con vista a la ciudad.',
                        'santa-ana' => 'Elegancia occidental. Platillos tradicionales con toque contemporáneo en Santa Ana.',
                        'san-miguel' => 'Fresco del oriente. Mariscos y platillos costeros en el dinamismo de San Miguel.',
                    ];
                @endphp

                @foreach($sedes as $sede)
                    <a href="{{ route('menu.sede', $sede->slug) }}" class="sede-menu-card fade-in-up">
                        <div class="sede-menu-card-icon">
                            <i class="bi {{ $sedeIcons[$sede->slug] ?? 'bi-geo-alt' }}"
                                style="color: var(--color-gold); opacity: 0.8;"></i>
                        </div>
                        <div class="sede-menu-card-content">
                            <p class="sede-menu-card-zona">
                                <span class="zona-dot"></span>
                                Zona {{ $sede->zona }}
                            </p>
                            <h2 class="sede-menu-card-nombre">{{ $sede->nombre }}</h2>
                            <div class="sede-menu-card-divider"></div>
                            <p class="sede-menu-card-desc">
                                {{ $sedeDescripciones[$sede->slug] ?? 'Descubre nuestros platillos exclusivos.' }}
                            </p>
                            <span class="sede-menu-card-cta">
                                Ver Menú Completo
                                <i class="bi bi-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════ CTA FINAL ══════════════════ --}}
    <section
        style="padding: 80px 0; background: var(--color-dark); text-align: center; position: relative; overflow: hidden;">
        <div
            style="position: absolute; top: 50%; left: -15%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(200, 162, 77, 0.06) 0%, transparent 70%); border-radius: 50%; transform: translateY(-50%); pointer-events: none;">
        </div>

        <div class="container" style="position: relative; z-index: 1;">
            <div class="fade-in-up">
                <p class="section-label" style="color: rgba(255, 255, 255, 0.3); font-size: 0.8rem;">Listo para Reservar</p>
                <h2 class="section-title" style="color: #fff; font-size: clamp(1.8rem, 4vw, 2.8rem);">
                    ¿No sabes qué elegir?
                </h2>
                <div class="gold-divider mx-auto" style="margin-bottom: 2.5rem;"></div>
                <p
                    style="color: rgba(255, 255, 255, 0.55); font-size: 0.9rem; max-width: 500px; margin: 0 auto 2.5rem; line-height: 1.8;">
                    Nuestro equipo puede ayudarte a elegir el platillo perfecto según tus preferencias.
                    Contáctanos o reserva una mesa ahora.
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('reservaciones.create') }}" class="btn-gold"
                        style="display: inline-flex; align-items: center; gap: 8px;">
                        <i class="bi bi-calendar-check"></i> Reservar Mesa
                    </a>
                    <a href="{{ route('contacto') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 14px 36px; 
                                  background: transparent; color: rgba(255, 255, 255, 0.6); font-family: var(--font-main); 
                                  font-size: 0.7rem; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; 
                                  text-decoration: none; border: 1.5px solid rgba(255, 255, 255, 0.15); 
                                  border-radius: 4px; transition: all 0.25s;"
                        onmouseover="this.style.borderColor='var(--color-gold)';this.style.color='var(--color-gold)'"
                        onmouseout="this.style.borderColor='rgba(255,255,255,0.15)';this.style.color='rgba(255,255,255,0.6)'">
                        <i class="bi bi-telephone"></i> Contactar
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        // Fade-in al hacer scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));
    </script>
@endpush