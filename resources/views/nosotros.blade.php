@extends('layouts.app')

@section('title', 'Nosotros — The Royale Palace')

@push('styles')
    <style>
        /* ── NOSOTROS HERO ────────────────────────────── */
        .nosotros-hero {
            padding: 100px 0 80px;
            background: linear-gradient(135deg, var(--color-bg-soft) 0%, var(--color-bg) 100%);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .nosotros-hero::before {
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

        .nosotros-hero::after {
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

        .nosotros-hero-content {
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

        .nosotros-hero .section-label {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--color-gold);
            margin-bottom: 1rem;
            display: block;
        }

        .nosotros-hero .section-title {
            font-size: clamp(2.2rem, 7vw, 4rem);
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--color-dark);
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }

        .nosotros-hero .gold-divider {
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

        .nosotros-hero .section-subtitle {
            font-size: 0.95rem;
            font-weight: 400;
            color: var(--color-muted);
            line-height: 1.8;
            max-width: 700px;
            margin: 0 auto;
        }

        /* ── HISTORIA SECTION ─────────────────────────── */
        .historia-section {
            padding: 100px 0;
            background: var(--color-bg);
            position: relative;
        }

        .historia-section::before {
            content: '';
            position: absolute;
            top: -10%;
            right: -5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(200, 162, 77, 0.03) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .historia-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
            animation: fadeInUp 0.6s ease forwards;
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

        .historia-text {
            color: var(--color-muted);
            font-size: 1rem;
            line-height: 2;
            text-align: center;
            margin-bottom: 2rem;
        }

        .historia-text strong {
            color: var(--color-gold);
            font-weight: 700;
        }

        /* ── EQUIPO SECTION ───────────────────────────── */
        .equipo-section {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--color-bg-soft) 0%, var(--color-bg) 100%);
            position: relative;
            overflow: hidden;
        }

        .equipo-section::before {
            content: '';
            position: absolute;
            top: -15%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(200, 162, 77, 0.04) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .equipo-header {
            text-align: center;
            margin-bottom: 4rem;
            position: relative;
            z-index: 1;
            animation: fadeInDown 0.8s ease forwards;
        }

        .equipo-header .section-label {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--color-gold);
            margin-bottom: 1rem;
            display: block;
        }

        .equipo-header .section-title {
            font-size: clamp(2rem, 6vw, 3.5rem);
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--color-dark);
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }

        .equipo-header .gold-divider {
            margin: 1.5rem auto 2rem;
        }

        .equipo-header .section-subtitle {
            font-size: 0.95rem;
            font-weight: 400;
            color: var(--color-muted);
            line-height: 1.8;
            max-width: 580px;
            margin: 0 auto;
        }

        /* ── TEAM IMAGE ───────────────────────────────– */
        .team-image-wrapper {
            position: relative;
            margin-bottom: 4rem;
            border-radius: 16px;
            overflow: hidden;
            animation: fadeInUp 0.8s ease 0.2s forwards;
            opacity: 0;
        }

        .team-image-wrapper::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(200, 162, 77, 0.1) 0%, rgba(48, 93, 66, 0.1) 100%);
            z-index: 2;
            pointer-events: none;
        }

        .team-image-wrapper img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.5s ease;
        }

        .team-image-wrapper:hover img {
            transform: scale(1.05);
        }

        /* ── EQUIPO GRID ──────────────────────────────– */
        .equipo-grid {
            position: relative;
            z-index: 1;
            margin-bottom: 4rem;
        }

        /* ── FUNDADORES ──────────────────────────���────– */
        .fundadores-subtitle {
            text-align: center;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--color-gold);
            margin-bottom: 2.5rem;
            display: block;
        }

        .fundadores-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 3rem;
            margin-bottom: 4rem;
        }

        /* ── MIEMBRO CARD ─────────────────────────────– */
        .miembro-card {
            background: var(--color-bg);
            border: 1px solid var(--color-line);
            border-radius: 12px;
            padding: 3rem 2rem;
            text-align: center;
            transition: all 0.35s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        .miembro-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: var(--color-gold);
            transition: width 0.35s ease;
            transform: translateX(-50%);
        }

        .miembro-card:hover {
            border-color: var(--color-gold);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
            transform: translateY(-8px);
        }

        .miembro-card:hover::before {
            width: 80%;
        }

        .miembro-avatar {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--color-gold), var(--color-green));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: #fff;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(200, 162, 77, 0.25);
        }

        .miembro-card:hover .miembro-avatar {
            transform: scale(1.15) rotate(-5deg);
            box-shadow: 0 10px 30px rgba(200, 162, 77, 0.4);
        }

        .miembro-nombre {
            font-size: 1.2rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--color-dark);
            margin-bottom: 0.5rem;
            transition: color 0.2s ease;
        }

        .miembro-card:hover .miembro-nombre {
            color: var(--color-gold);
        }

        .miembro-rol {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--color-gold);
            margin-bottom: 1.5rem;
            display: block;
        }

        .miembro-desc {
            font-size: 0.9rem;
            color: var(--color-muted);
            line-height: 1.8;
            flex: 1;
            margin-bottom: 1.5rem;
        }

        .miembro-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--color-green);
            background: rgba(48, 93, 66, 0.1);
            border: 1px solid rgba(48, 93, 66, 0.2);
            padding: 6px 14px;
            border-radius: 20px;
            transition: all 0.2s ease;
        }

        .miembro-card:hover .miembro-badge {
            background: rgba(48, 93, 66, 0.2);
            border-color: var(--color-green);
        }

        /* ── GERENTES GRID ────────────────────────────– */
        .gerentes-subtitle {
            text-align: center;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--color-gold);
            margin-bottom: 2.5rem;
            display: block;
            margin-top: 2rem;
        }

        .gerentes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 2.5rem;
        }

        /* ── VALUES SECTION ───────────────────────────– */
        .values-section {
            padding: 100px 0;
            background: var(--color-dark);
            position: relative;
            overflow: hidden;
        }

        .values-section::before {
            content: '';
            position: absolute;
            top: 50%;
            right: -15%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(200, 162, 77, 0.06) 0%, transparent 70%);
            border-radius: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .values-content {
            position: relative;
            z-index: 1;
        }

        .values-header {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeInDown 0.8s ease forwards;
        }

        .values-header .section-label {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--color-gold);
            margin-bottom: 0.75rem;
            display: block;
        }

        .values-header .section-title {
            font-size: clamp(1.8rem, 5vw, 2.8rem);
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #fff;
            margin-bottom: 2rem;
            line-height: 1.2;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2.5rem;
        }

        .value-item {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(200, 162, 77, 0.2);
            border-radius: 12px;
            padding: 2rem;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        .value-item:hover {
            background: rgba(200, 162, 77, 0.1);
            border-color: var(--color-gold);
            transform: translateY(-4px);
        }

        .value-icon {
            font-size: 2.2rem;
            margin-bottom: 1rem;
            display: block;
            color: var(--color-gold);
            transition: transform 0.3s ease;
        }

        .value-item:hover .value-icon {
            transform: scale(1.2);
        }

        .value-title {
            font-size: 1rem;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #fff;
            margin-bottom: 0.75rem;
        }

        .value-desc {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.6);
            line-height: 1.7;
        }

        /* ── RESPONSIVE ───────────────────────────────– */
        @media (max-width: 768px) {
            .nosotros-hero {
                padding: 60px 0 50px;
            }

            .nosotros-hero .section-title {
                font-size: 2rem;
            }

            .equipo-section {
                padding: 80px 0;
            }

            .fundadores-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .gerentes-grid {
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 1.5rem;
            }

            .miembro-card {
                padding: 2rem 1.5rem;
            }

            .miembro-avatar {
                width: 80px;
                height: 80px;
                font-size: 2rem;
            }

            .miembro-nombre {
                font-size: 1rem;
            }

            .values-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1.5rem;
            }

            .value-item {
                padding: 1.5rem;
            }
        }
    </style>
@endpush

@section('content')

    {{-- ═══════════════════ NOSOTROS HERO ════════════════ --}}
    <section class="nosotros-hero">
        <div class="container">
            <div class="nosotros-hero-content">
                <p class="section-label">Nuestra Historia</p>
                <h1 class="section-title">Tradición Y Elegancia</h1>
                <div class="gold-divider mx-auto"></div>
                <p class="section-subtitle">
                    The Royale Palace nació del amor profundo por la cocina salvadoreña<br>
                    y el deseo de elevarla a su máxima expresión.
                </p>
            </div>
        </div>
    </section>

    {{-- ═══════════════════ HISTORIA ════════════════════ --}}
    <section class="historia-section">
        <div class="container">
            <div class="historia-content">
                <p class="historia-text">
                    The Royale Palace nació del amor por la cocina salvadoreña y el deseo de elevarla a su máxima
                    expresión. Con <strong>ingredientes locales de primera calidad</strong> y
                    <strong>técnicas contemporáneas</strong>, cada platillo es un homenaje a la identidad nacional.
                </p>
                <p class="historia-text">
                    <strong>Tres sedes. Una misma pasión.</strong> La gastronomía salvadoreña como nunca la habías
                    vivido. En cada plato, en cada sede, llevamos el orgullo y la dedicación de un equipo que cree
                    en la excelencia.
                </p>
            </div>
        </div>
    </section>

    {{-- ═══════════════════ EQUIPO ═══════════════════════ --}}
    <section class="equipo-section">
        <div class="container">
            <div class="equipo-header">
                <p class="section-label">El Corazón del Proyecto</p>
                <h2 class="section-title">Nuestro Equipo</h2>
                <div class="gold-divider mx-auto"></div>
                <p class="section-subtitle">
                    Fundadores y gerentes dedicados a llevar la gastronomía salvadoreña a nuevas alturas.
                </p>
            </div>

            {{-- Team Image --}}
            <div class="team-image-wrapper">
                <img src="{{ asset('images/team.jpg') }}" alt="Equipo The Royale Palace"
                    style="width: 100%; border-radius: 16px;">
            </div>

            <div class="equipo-grid">
                {{-- FUNDADORES --}}
                <span class="fundadores-subtitle">
                    <i class="bi bi-star-fill"></i> Fundadores
                </span>

                <div class="fundadores-grid">
                    {{-- Fundador 1 --}}
                    <div class="miembro-card" style="animation-delay: 0s;">
                        <div class="miembro-avatar">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <h3 class="miembro-nombre">Samuel Cornejo</h3>
                        <p class="miembro-rol">Fundador & Visión Gastronómica</p>
                        <p class="miembro-desc">
                            Emprendedor salvadoreño con pasión por rescatar y modernizar la cocina tradicional de El
                            Salvador.
                        </p>
                        <span class="miembro-badge">
                            <i class="bi bi-lightbulb-fill"></i> Visión
                        </span>
                    </div>

                    {{-- Fundador 2 --}}
                    <div class="miembro-card" style="animation-delay: 0.15s;">
                        <div class="miembro-avatar">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <h3 class="miembro-nombre">Yony Rodríguez</h3>
                        <p class="miembro-rol">Fundadora & Operaciones</p>
                        <p class="miembro-desc">
                            Empresaria con experiencia en gastronomía y gestión de establecimientos de lujo.
                        </p>
                        <span class="miembro-badge">
                            <i class="bi bi-gear-fill"></i> Excelencia
                        </span>
                    </div>
                </div>

                {{-- GERENTES --}}
                <span class="gerentes-subtitle">
                    <i class="bi bi-briefcase-fill"></i> Gerentes por Sede
                </span>

                <div class="gerentes-grid">
                    {{-- Gerente San Salvador --}}
                    <div class="miembro-card" style="animation-delay: 0.3s;">
                        <div class="miembro-avatar">
                            <i class="bi bi-briefcase-fill"></i>
                        </div>
                        <h3 class="miembro-nombre">Rocío Rivas</h3>
                        <p class="miembro-rol">Gerente San Salvador</p>
                        <p class="miembro-desc">
                            Profesional con 10 años de experiencia en gestión de restaurantes de alto nivel.
                        </p>
                        <span class="miembro-badge">
                            <i class="bi bi-geo-alt-fill"></i> Central
                        </span>
                    </div>

                    {{-- Gerente Santa Ana --}}
                    <div class="miembro-card" style="animation-delay: 0.45s;">
                        <div class="miembro-avatar">
                            <i class="bi bi-briefcase-fill"></i>
                        </div>
                        <h3 class="miembro-nombre">Danilo Chicas</h3>
                        <p class="miembro-rol">Gerente Santa Ana</p>
                        <p class="miembro-desc">
                            Líder en servicio al cliente con dedicación a mantener estándares de excelencia.
                        </p>
                        <span class="miembro-badge">
                            <i class="bi bi-sunset-fill"></i> Occidente
                        </span>
                    </div>

                    {{-- Gerente San Miguel --}}
                    <div class="miembro-card" style="animation-delay: 0.6s;">
                        <div class="miembro-avatar">
                            <i class="bi bi-briefcase-fill"></i>
                        </div>
                        <h3 class="miembro-nombre">Alan Orellana</h3>
                        <p class="miembro-rol">Gerente San Miguel</p>
                        <p class="miembro-desc">
                            Especialista en operaciones con enfoque en innovación y mejora continua.
                        </p>
                        <span class="miembro-badge">
                            <i class="bi bi-water"></i> Oriente
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════ VALORES ═════════════════════ --}}
    <section class="values-section">
        <div class="container">
            <div class="values-header">
                <p class="section-label">Lo que Nos Define</p>
                <h2 class="section-title">Nuestros Valores</h2>
            </div>

            <div class="values-grid">
                {{-- Calidad --}}
                <div class="value-item" style="animation-delay: 0s;">
                    <span class="value-icon">
                        <i class="bi bi-gem"></i>
                    </span>
                    <h3 class="value-title">Excelencia</h3>
                    <p class="value-desc">
                        Cada platillo, cada servicio, cada detalle es hecho con la máxima dedicación y calidad.
                    </p>
                </div>

                {{-- Tradición --}}
                <div class="value-item" style="animation-delay: 0.1s;">
                    <span class="value-icon">
                        <i class="bi bi-book-half"></i>
                    </span>
                    <h3 class="value-title">Tradición</h3>
                    <p class="value-desc">
                        Respetamos las raíces de la gastronomía salvadoreña mientras la llevamos al futuro.
                    </p>
                </div>

                {{-- Innovación --}}
                <div class="value-item" style="animation-delay: 0.2s;">
                    <span class="value-icon">
                        <i class="bi bi-lightning-fill"></i>
                    </span>
                    <h3 class="value-title">Innovación</h3>
                    <p class="value-desc">
                        Combinamos técnicas modernas con sabores auténticos para crear experiencias únicas.
                    </p>
                </div>

                {{-- Pasión --}}
                <div class="value-item" style="animation-delay: 0.3s;">
                    <span class="value-icon">
                        <i class="bi bi-heart-fill"></i>
                    </span>
                    <h3 class="value-title">Pasión</h3>
                    <p class="value-desc">
                        Todo lo que hacemos es impulsado por el amor a la gastronomía y a nuestro país.
                    </p>
                </div>

                {{-- Comunidad --}}
                <div class="value-item" style="animation-delay: 0.4s;">
                    <span class="value-icon">
                        <i class="bi bi-people-fill"></i>
                    </span>
                    <h3 class="value-title">Comunidad</h3>
                    <p class="value-desc">
                        Somos parte de un ecosistema de productores locales que comparten nuestra visión.
                    </p>
                </div>

                {{-- Sostenibilidad --}}
                <div class="value-item" style="animation-delay: 0.5s;">
                    <span class="value-icon">
                        <i class="bi bi-leaf"></i>
                    </span>
                    <h3 class="value-title">Sostenibilidad</h3>
                    <p class="value-desc">
                        Comprometidos con prácticas responsables que cuiden nuestro entorno y futuro.
                    </p>
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
                    entry.target.style.opacity = '1';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        // Observar cards de miembros
        document.querySelectorAll('.miembro-card').forEach(card => {
            observer.observe(card);
        });

        // Observar items de valores
        document.querySelectorAll('.value-item').forEach(item => {
            observer.observe(item);
        });
    </script>
@endpush