@extends('layouts.app')

@section('title', 'Contacto — The Royale Palace')

@push('styles')
    <style>
        /* ── CONTACTO HERO ────────────────────────────── */
        .contacto-hero {
            padding: 100px 0 80px;
            background: linear-gradient(135deg, var(--color-bg-soft) 0%, var(--color-bg) 100%);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .contacto-hero::before {
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

        .contacto-hero::after {
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

        .contacto-hero-content {
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

        .contacto-hero .section-label {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--color-gold);
            margin-bottom: 1rem;
            display: block;
        }

        .contacto-hero .section-title {
            font-size: clamp(2.2rem, 7vw, 4rem);
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--color-dark);
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }

        .contacto-hero .gold-divider {
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

        .contacto-hero .section-subtitle {
            font-size: 0.95rem;
            font-weight: 400;
            color: var(--color-muted);
            line-height: 1.8;
            max-width: 580px;
            margin: 0 auto;
        }

        /* ── CONTACTO GRID ────────────────────────────── */
        .contacto-section {
            padding: 100px 0;
            background: var(--color-bg);
            position: relative;
        }

        .contacto-section::before {
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

        .contacto-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2.5rem;
            margin-bottom: 4rem;
            position: relative;
            z-index: 1;
        }

        /* ── CONTACTO CARD ────────────────────────────– */
        .contacto-card {
            background: var(--color-bg);
            border: 1px solid var(--color-line);
            border-radius: 12px;
            padding: 2.5rem 2rem;
            text-align: center;
            transition: all 0.35s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .contacto-card::before {
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

        .contacto-card:hover {
            border-color: var(--color-gold);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
            transform: translateY(-6px);
        }

        .contacto-card:hover::before {
            width: 60%;
        }

        .contacto-card-icon {
            width: 64px;
            height: 64px;
            background: rgba(200, 162, 77, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: var(--color-gold);
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .contacto-card:hover .contacto-card-icon {
            background: rgba(200, 162, 77, 0.2);
            transform: scale(1.1) rotate(5deg);
        }

        .contacto-card-label {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--color-gold);
            margin-bottom: 0.75rem;
            display: block;
        }

        .contacto-card-content {
            font-size: 0.95rem;
            color: var(--color-dark);
            font-weight: 600;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .contacto-card-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-gold);
            text-decoration: none;
            transition: all 0.2s ease;
            padding-top: 1rem;
            border-top: 1px solid var(--color-line);
            width: 100%;
            justify-content: center;
            margin-top: 1rem;
        }

        .contacto-card-link:hover {
            color: var(--color-gold-hover);
            gap: 10px;
        }

        /* ── FORMULARIO ───────────────────────────────– */
        .contacto-form-section {
            background: linear-gradient(135deg, var(--color-bg-soft) 0%, rgba(200, 162, 77, 0.03) 100%);
            padding: 60px 0;
            border-top: 1px solid var(--color-line);
            position: relative;
        }

        .contacto-form-section::before {
            content: '';
            position: absolute;
            bottom: -15%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(48, 93, 66, 0.04) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .contacto-form-wrap {
            background: var(--color-bg);
            border: 1px solid var(--color-line);
            border-radius: 12px;
            padding: 3rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 1;
            max-width: 600px;
            margin: 0 auto;
        }

        .contacto-form-title {
            font-size: 1.2rem;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-dark);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .contacto-form-title i {
            color: var(--color-gold);
            font-size: 1.4rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label-custom {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-muted);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-control-custom {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--color-line);
            background: var(--color-bg-soft);
            font-family: var(--font-main);
            font-size: 0.9rem;
            color: var(--color-dark);
            outline: none;
            transition: all 0.3s ease;
            border-radius: 6px;
        }

        .form-control-custom:focus {
            border-color: var(--color-gold);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(200, 162, 77, 0.1);
        }

        .form-control-custom::placeholder {
            color: rgba(0, 0, 0, 0.3);
        }

        textarea.form-control-custom {
            resize: vertical;
            min-height: 120px;
        }

        .btn-enviar {
            width: 100%;
            padding: 14px;
            background: var(--color-gold);
            color: #fff;
            font-family: var(--font-main);
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }

        .btn-enviar::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--color-gold-hover);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .btn-enviar:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(200, 162, 77, 0.4);
        }

        .btn-enviar:hover::before {
            left: 0;
        }

        /* ── HORARIOS ─────────────────────────────────– */
        .horarios-section {
            padding: 80px 0;
            background: var(--color-dark);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .horarios-section::before {
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

        .horarios-content {
            position: relative;
            z-index: 1;
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

        .horarios-title {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.3);
            margin-bottom: 0.75rem;
            display: block;
        }

        .horarios-heading {
            font-size: clamp(1.8rem, 5vw, 2.8rem);
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #fff;
            margin-bottom: 2rem;
            line-height: 1.2;
        }

        .horarios-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .horario-item {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 2rem;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .horario-item:hover {
            background: rgba(200, 162, 77, 0.1);
            border-color: var(--color-gold);
            transform: translateY(-4px);
        }

        .horario-dia {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--color-gold);
            margin-bottom: 0.5rem;
        }

        .horario-tiempo {
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 1px;
        }

        /* ── RESPONSIVE ───────────────────────────────– */
        @media (max-width: 768px) {
            .contacto-hero {
                padding: 60px 0 50px;
            }

            .contacto-hero .section-title {
                font-size: 2rem;
            }

            .contacto-grid {
                gap: 1.5rem;
            }

            .contacto-card {
                padding: 2rem 1.5rem;
            }

            .contacto-form-wrap {
                padding: 2rem 1.5rem;
            }

            .horarios-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')

    {{-- ═══════════════════ CONTACTO HERO ════════════════ --}}
    <section class="contacto-hero">
        <div class="container">
            <div class="contacto-hero-content">
                <p class="section-label">Estamos para Servirte</p>
                <h1 class="section-title">Contacto</h1>
                <div class="gold-divider mx-auto"></div>
                <p class="section-subtitle">
                    ¿Preguntas? Estamos disponibles para ayudarte.<br>
                    Comunícate con nosotros por cualquiera de nuestros canales.
                </p>
            </div>
        </div>
    </section>

    {{-- ═══════════════════ CANALES DE CONTACTO ═════════ --}}
    <section class="contacto-section">
        <div class="container">
            <div class="contacto-grid">
                {{-- Correo --}}
                <div class="contacto-card fade-in-up">
                    <div class="contacto-card-icon">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <p class="contacto-card-label">Correo Electrónico</p>
                    <p class="contacto-card-content">
                        reservaciones@theroyalepalace.sv
                    </p>
                    <a href="mailto:reservaciones@theroyalepalace.sv" class="contacto-card-link">
                        Enviar Email
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                {{-- Teléfono --}}
                <div class="contacto-card fade-in-up" style="animation-delay: 0.1s;">
                    <div class="contacto-card-icon">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <p class="contacto-card-label">Teléfono</p>
                    <p class="contacto-card-content">
                        +503 2200-0000
                    </p>
                    <a href="tel:+5032200000" class="contacto-card-link">
                        Llamar Ahora
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                {{-- Ubicación --}}
                <div class="contacto-card fade-in-up" style="animation-delay: 0.2s;">
                    <div class="contacto-card-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <p class="contacto-card-label">Ubicación</p>
                    <p class="contacto-card-content">
                        3 Sedes en El Salvador
                    </p>
                    <a href="{{ route('sucursales') }}" class="contacto-card-link">
                        Ver Sedes
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════ FORMULARIO DE CONTACTO ══════════ --}}
    <section class="contacto-form-section">
        <div class="container">
            <div class="contacto-form-wrap fade-in-up">
                <h2 class="contacto-form-title">
                    <i class="bi bi-chat-dots"></i> Envíanos un Mensaje
                </h2>

                <form action="#" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="form-label-custom">
                            <i class="bi bi-person"></i> Nombre Completo
                        </label>
                        <input type="text" name="nombre" class="form-control-custom" 
                               placeholder="Tu nombre" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label-custom">
                            <i class="bi bi-envelope"></i> Correo Electrónico
                        </label>
                        <input type="email" name="email" class="form-control-custom" 
                               placeholder="tu@correo.com" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label-custom">
                            <i class="bi bi-telephone"></i> Teléfono (Opcional)
                        </label>
                        <input type="tel" name="telefono" class="form-control-custom" 
                               placeholder="+503 0000-0000">
                    </div>

                    <div class="form-group">
                        <label class="form-label-custom">
                            <i class="bi bi-chat-left"></i> Asunto
                        </label>
                        <select name="asunto" class="form-control-custom" required>
                            <option value="">Selecciona un asunto</option>
                            <option value="reservacion">Información sobre Reservaciones</option>
                            <option value="menu">Consulta sobre Menú</option>
                            <option value="evento">Eventos Especiales</option>
                            <option value="feedback">Feedback y Sugerencias</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label-custom">
                            <i class="bi bi-chat-dots"></i> Mensaje
                        </label>
                        <textarea name="mensaje" class="form-control-custom" 
                                  placeholder="Cuéntanos, ¿en qué podemos ayudarte?" required></textarea>
                    </div>

                    <button type="submit" class="btn-enviar">
                        <i class="bi bi-send"></i> Enviar Mensaje
                    </button>
                </form>
            </div>
        </div>
    </section>

    {{-- ═══════════════════ HORARIOS ════════════════════ --}}
    <section class="horarios-section">
        <div class="container">
            <div class="horarios-content">
                <p class="horarios-title">
                    <i class="bi bi-clock"></i> Nuestro Horario
                </p>
                <h2 class="horarios-heading">Abierto para Ti</h2>

                <div class="horarios-grid">
                    <div class="horario-item">
                        <p class="horario-dia">Lunes a Jueves</p>
                        <p class="horario-tiempo">11:00 AM - 10:00 PM</p>
                    </div>
                    <div class="horario-item">
                        <p class="horario-dia">Viernes a Domingo</p>
                        <p class="horario-tiempo">11:00 AM - 11:00 PM</p>
                    </div>
                </div>

                <div style="margin-top: 3rem;">
                    <p style="color: rgba(255, 255, 255, 0.5); font-size: 0.85rem; letter-spacing: 1px;">
                        ¿Aún tienes dudas? Escríbenos arriba y nos pondremos en contacto pronto.
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
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));

        // Validación simple del formulario
        document.querySelector('form').addEventListener('submit', function(e) {
            const nombre = this.querySelector('input[name="nombre"]').value.trim();
            const email = this.querySelector('input[name="email"]').value.trim();
            const mensaje = this.querySelector('textarea[name="mensaje"]').value.trim();

            if (!nombre || !email || !mensaje) {
                e.preventDefault();
                alert('Por favor completa todos los campos requeridos.');
                return false;
            }

            // Aquí puedes agregar lógica adicional o enviar el formulario
            // Por ahora, mostraremos un mensaje de éxito
            alert('¡Gracias por tu mensaje! Nos pondremos en contacto pronto.');
        });
    </script>
@endpush
