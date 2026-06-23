<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión — The Royale Palace</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
            --color-error: #E53935;
            --color-success: #305D42;
            --font-main: 'Montserrat', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-main);
            background: linear-gradient(135deg, var(--color-bg-soft) 0%, var(--color-bg) 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Fondo decorativo - animado */
        body::before {
            content: '';
            position: fixed;
            top: -30%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(200, 162, 77, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
            animation: floatBefore 20s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -20%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(48, 93, 66, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
            animation: floatAfter 25s ease-in-out infinite;
        }

        @keyframes floatBefore {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(30px); }
        }

        @keyframes floatAfter {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-30px); }
        }

        .page-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        /* LEFT SIDE - BRANDING */
        .login-hero {
            background: linear-gradient(135deg, var(--color-dark) 0%, #1a1a1a 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .login-hero::before {
            content: '';
            position: absolute;
            top: 50%;
            right: -15%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(200, 162, 77, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .login-hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 400px;
            animation: fadeInLeft 0.8s ease forwards;
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .hero-logo {
            width: 150px;
            height: 150px;
            object-fit: contain;
            margin-bottom: 1.5rem;
            filter: brightness(1.1);
            transition: transform 0.3s ease;
        }

        .hero-logo:hover {
            transform: scale(1.05);
        }

        .hero-title {
            font-size: 2.2rem;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #fff;
            line-height: 1.1;
            margin-bottom: 1rem;
        }

        .hero-title span {
            color: var(--color-gold);
        }

        .hero-divider {
            width: 50px;
            height: 2px;
            background: var(--color-gold);
            margin: 1.5rem auto;
        }

        .hero-description {
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.6);
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .hero-features {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
            text-align: left;
            margin-top: 2.5rem;
        }

        .hero-feature {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: rgba(200, 162, 77, 0.15);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--color-gold);
            flex-shrink: 0;
        }

        .feature-text {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .feature-title {
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #fff;
        }

        .feature-desc {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.5);
            line-height: 1.5;
        }

        /* RIGHT SIDE - AUTH FORM */
        .login-form-side {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            background: var(--color-bg);
            overflow-y: auto;
            max-height: 100vh;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 420px;
            animation: fadeInRight 0.8s ease forwards;
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Logo pequeño - Solo en mobile */
        .auth-brand-mobile {
            display: none;
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-brand-mobile a {
            text-decoration: none;
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .auth-brand-mobile-logo {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .auth-brand-mobile-name {
            font-size: 0.9rem;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-dark);
        }

        .auth-brand-mobile-name span {
            color: var(--color-gold);
        }

        /* Card del formulario */
        .auth-card {
            background: var(--color-bg);
            border: 1px solid var(--color-line);
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
            position: relative;
            z-index: 1;
        }

        .auth-card-header {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1.5px solid var(--color-line);
        }

        .auth-card-title {
            font-size: 1.1rem;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-dark);
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
        }

        .auth-card-title i {
            font-size: 1.3rem;
            color: var(--color-gold);
        }

        .auth-card-subtitle {
            font-size: 0.75rem;
            color: var(--color-muted);
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 0.5rem;
        }

        /* Labels e inputs */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
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

        .form-label i {
            color: var(--color-gold);
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid var(--color-line);
            background: var(--color-bg-soft);
            font-family: var(--font-main);
            font-size: 0.9rem;
            color: var(--color-dark);
            outline: none;
            transition: all 0.3s ease;
            border-radius: 8px;
            position: relative;
        }

        .form-input::placeholder {
            color: rgba(0, 0, 0, 0.3);
        }

        .form-input:focus {
            border-color: var(--color-gold);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(200, 162, 77, 0.08);
            transform: translateY(-2px);
        }

        .form-input.error {
            border-color: var(--color-error);
            background: rgba(229, 57, 53, 0.03);
        }

        .form-input.error:focus {
            box-shadow: 0 0 0 4px rgba(229, 57, 53, 0.08);
        }

        .form-error {
            font-size: 0.7rem;
            color: var(--color-error);
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 5px;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Checkbox remember */
        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 0.75rem;
            color: var(--color-muted);
            user-select: none;
            transition: color 0.2s;
        }

        .checkbox-label:hover {
            color: var(--color-dark);
        }

        .checkbox-label input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--color-gold);
            cursor: pointer;
            border-radius: 4px;
        }

        .forgot-link {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--color-gold);
            text-decoration: none;
            letter-spacing: 0.5px;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .forgot-link:hover {
            color: var(--color-gold-hover);
            gap: 6px;
        }

        /* Botón submit */
        .btn-submit {
            width: 100%;
            padding: 15px;
            background: var(--color-gold);
            color: #fff;
            font-family: var(--font-main);
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(200, 162, 77, 0.2);
        }

        .btn-submit::before {
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

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(200, 162, 77, 0.35);
        }

        .btn-submit:hover::before {
            left: 0;
        }

        .btn-submit:active {
            transform: translateY(-1px);
        }

        /* Divider */
        .auth-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 2rem 0;
            position: relative;
        }

        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--color-line);
        }

        .auth-divider span {
            font-size: 0.65rem;
            color: var(--color-muted);
            letter-spacing: 1px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        /* Enlace registro */
        .register-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px;
            background: transparent;
            border: 1.5px solid var(--color-line);
            border-radius: 8px;
            font-family: var(--font-main);
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-dark);
            text-decoration: none;
            transition: all 0.25s;
            cursor: pointer;
        }

        .register-link:hover {
            border-color: var(--color-gold);
            color: var(--color-gold);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(200, 162, 77, 0.15);
        }

        /* Volver al inicio */
        .back-home {
            text-align: center;
            margin-top: 1.5rem;
        }

        .back-home a {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--color-muted);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }

        .back-home a:hover {
            color: var(--color-gold);
            gap: 8px;
        }

        /* Alert de sesión */
        .session-status {
            padding: 1rem;
            background: rgba(48, 93, 66, 0.1);
            border-left: 3px solid var(--color-success);
            border-radius: 6px;
            font-size: 0.8rem;
            color: var(--color-success);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 8px;
            animation: slideDown 0.3s ease;
        }

        .session-status i {
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .page-container {
                grid-template-columns: 1fr;
            }

            .login-hero {
                display: none;
            }

            .login-form-side {
                min-height: 100vh;
                padding: 2rem 1rem;
            }

            .auth-brand-mobile {
                display: flex;
            }

            .auth-card {
                padding: 2rem;
            }

            .auth-wrapper {
                max-width: 380px;
            }
        }

        @media (max-width: 480px) {
            .login-form-side {
                padding: 1.5rem 1rem;
            }

            .auth-card {
                padding: 1.5rem;
                border-radius: 10px;
            }

            .auth-wrapper {
                max-width: 100%;
            }

            .remember-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }

            .hero-features {
                display: none;
            }

            .form-input {
                padding: 12px 14px;
                font-size: 0.88rem;
            }

            .btn-submit {
                padding: 13px;
            }
        }
    </style>
</head>

<body>

    <div class="page-container">

        {{-- LEFT SIDE - HERO --}}
        <div class="login-hero">
            <div class="login-hero-content">
                <center>
                <img src="{{ asset('images/logo-b.png') }}" alt="The Royale Palace" class="hero-logo"
                    onerror="this.style.display='none'">
                    </center>

                <h1 class="hero-title">The <span>Royale</span> Palace</h1>
                <div class="hero-divider"></div>

                <p class="hero-description">
                    Accede a tu cuenta y disfruta de una experiencia gastronómica única. Reserva mesas, explora nuestro menú y mucho más.
                </p>

                <div class="hero-features">
                    <div class="hero-feature">
                        <div class="feature-icon">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div class="feature-text">
                            <span class="feature-title">Reservaciones</span>
                            <span class="feature-desc">Reserva tu mesa al instante</span>
                        </div>
                    </div>

                    <div class="hero-feature">
                        <div class="feature-icon">
                            <i class="bi bi-heart"></i>
                        </div>
                        <div class="feature-text">
                            <span class="feature-title">Favoritos</span>
                            <span class="feature-desc">Guarda tus platillos preferidos</span>
                        </div>
                    </div>

                    <div class="hero-feature">
                        <div class="feature-icon">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <div class="feature-text">
                            <span class="feature-title">Exclusivo</span>
                            <span class="feature-desc">Acceso a ofertas especiales</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT SIDE - AUTH FORM --}}
        <div class="login-form-side">

            <div class="auth-wrapper">

                {{-- Logo Mobile --}}
                <div class="auth-brand-mobile">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="The Royale Palace"
                            class="auth-brand-mobile-logo" onerror="this.style.display='none'">
                        <div class="auth-brand-mobile-name">The <span>Royale</span> Palace</div>
                    </a>
                </div>

                {{-- Card --}}
                <div class="auth-card">

                    <div class="auth-card-header">
                        <h2 class="auth-card-title">
                            <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                        </h2>
                        <p class="auth-card-subtitle">Bienvenido de vuelta</p>
                    </div>

                    {{-- Session status --}}
                    @if (session('status'))
                        <div class="session-status">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>{{ session('status') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" autocomplete="off">
                        @csrf

                        {{-- Email --}}
                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-envelope"></i> Correo Electrónico
                            </label>
                            <input type="email" name="email"
                                class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                                value="{{ old('email') }}" placeholder="tu@correo.com" required autofocus
                                autocomplete="email">
                            @error('email')
                                <p class="form-error">
                                    <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-lock"></i> Contraseña
                            </label>
                            <input type="password" name="password"
                                class="form-input {{ $errors->has('password') ? 'error' : '' }}"
                                placeholder="••••••••" required autocomplete="current-password">
                            @error('password')
                                <p class="form-error">
                                    <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Remember + Forgot --}}
                        <div class="remember-row">
                            <label class="checkbox-label">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                Mantener sesión iniciada
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-link">
                                    <i class="bi bi-question-circle"></i> ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                        </button>
                    </form>

                    {{-- Divider --}}
                    <div class="auth-divider">
                        <span>¿No tienes cuenta?</span>
                    </div>

                    {{-- Register link --}}
                    <a href="{{ route('register') }}" class="register-link">
                        <i class="bi bi-person-plus"></i> Crear Cuenta Nueva
                    </a>

                    {{-- Back home --}}
                    <div class="back-home">
                        <a href="{{ route('home') }}">
                            <i class="bi bi-arrow-left"></i> Volver al Inicio
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
