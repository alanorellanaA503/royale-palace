@extends('layouts.app')

@section('title', 'The Royale Palace — Sabores Auténticos de El Salvador')

@push('styles')
    <style>
        /* ── VARIABLES ─────────────────────────────────────── */
        :root {
            --color-gold: #C8A24D;
            --color-gold-hover: #A8862C;
            --color-gold-light: #E8D9B8;
            --color-green: #305D42;
            --color-dark: #111111;
            --color-muted: #555555;
            --color-line: #E5E5E5;
            --color-bg: #FFFFFF;
            --color-bg-soft: #F8F8F8;
            --font-main: 'Montserrat', sans-serif;
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
        }

        /* ── HERO CON VIDEO ─────────────────────────────────── */
        .trp-hero {
            position: relative;
            height: 100vh;
            min-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
            margin-top: -70px;
        }

        .hero-video-wrapper {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .hero-video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translateX(-50%) translateY(-50%);
            object-fit: cover;
        }

        .hero-video-wrapper::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.25);
            z-index: 1;
            backdrop-filter: blur(2px);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom,
                    rgba(0, 0, 0, 0.65) 0%,
                    rgba(0, 0, 0, 0.45) 50%,
                    rgba(0, 0, 0, 0.75) 100%);
            z-index: 2;
        }

        .hero-content {
            position: relative;
            z-index: 3;
            color: #fff;
            padding: 0 1.5rem;
            animation: heroFadeUp 1.2s ease forwards;
            opacity: 0;
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        @keyframes heroFadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-label {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 6px;
            text-transform: uppercase;
            color: var(--color-gold);
            margin-bottom: 1.5rem;
            display: block;
        }

        .hero-title {
            font-size: clamp(3rem, 9vw, 7rem);
            font-weight: 800;
            letter-spacing: 6px;
            text-transform: uppercase;
            color: #fff;
            line-height: 1;
            margin-bottom: 1.5rem;
        }

        .hero-title span {
            color: var(--color-gold);
            display: inline-block;
        }

        .hero-subtitle {
            font-size: clamp(0.75rem, 1.5vw, 0.9rem);
            font-weight: 400;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 3rem;
            line-height: 2;
        }

        .hero-divider {
            width: 60px;
            height: 1.5px;
            background: var(--color-gold);
            margin: 0 auto 2.5rem;
            animation: expandWidth 0.8s ease 0.4s forwards;
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
                width: 60px;
            }
        }

        .hero-ctas {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .hero-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 36px;
            font-family: var(--font-main);
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            text-decoration: none;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }

        .hero-btn-primary {
            background: var(--color-gold);
            color: #fff;
        }

        .hero-btn-primary::before {
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

        .hero-btn-primary:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(200, 162, 77, 0.4);
        }

        .hero-btn-primary:hover::before {
            left: 0;
        }

        .hero-btn-secondary {
            background: transparent;
            color: #fff;
            border: 1.5px solid rgba(255, 255, 255, 0.4);
        }

        .hero-btn-secondary::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(200, 162, 77, 0.1);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .hero-btn-secondary:hover {
            border-color: var(--color-gold);
            color: var(--color-gold);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(200, 162, 77, 0.2);
        }

        .hero-btn-secondary:hover::after {
            left: 0;
        }

        .hero-scroll {
            position: absolute;
            bottom: 2.5rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 3;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.6rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            animation: bounce 2s infinite;
            cursor: pointer;
            transition: var(--transition-smooth);
        }

        .hero-scroll:hover {
            color: rgba(255, 255, 255, 0.8);
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            50% {
                transform: translateX(-50%) translateY(6px);
            }
        }

        /* ── STATS ────────────────────────────────────── */
        .stats-section {
            padding: 80px 0;
            background: var(--color-dark);
            position: relative;
            overflow: hidden;
        }

        .stats-section::before {
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

        .stat-item {
            text-align: center;
            padding: 0 1rem;
            position: relative;
            z-index: 1;
        }

        .stat-number {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            color: var(--color-gold);
            line-height: 1;
            margin-bottom: 0.5rem;
            animation: countUp 2s ease-out;
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .stat-label {
            font-size: 0.6rem;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.35);
        }

        /* ── HISTORIA ─────────────────────────────────── */
        .historia-section {
            padding: 120px 0;
            background: var(--color-bg);
            position: relative;
        }

        .historia-numero {
            font-size: 7rem;
            font-weight: 800;
            color: #292929;
            line-height: 1;
            margin-bottom: -1.5rem;
            user-select: none;
        }

        .section-label {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--color-gold);
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: clamp(1.8rem, 4vw, 3rem);
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--color-dark);
            line-height: 1.2;
        }

        .gold-divider {
            width: 50px;
            height: 2px;
            background: var(--color-gold);
            margin: 1.5rem 0;
        }

        .section-subtitle {
            font-size: 0.9rem;
            color: var(--color-muted);
            line-height: 1.8;
        }

        .btn-outline-gold {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-gold);
            border: 1.5px solid var(--color-gold);
            border-radius: 4px;
            text-decoration: none;
            transition: var(--transition-smooth);
            background: transparent;
            cursor: pointer;
        }

        .btn-outline-gold:hover {
            background: var(--color-gold);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(200, 162, 77, 0.3);
        }

        .btn-gold {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 28px;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #fff;
            background: var(--color-gold);
            border: none;
            border-radius: 4px;
            text-decoration: none;
            transition: var(--transition-smooth);
            cursor: pointer;
        }

        .btn-gold:hover {
            background: var(--color-gold-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(200, 162, 77, 0.3);
            color: #fff;
        }

        .zona-card {
            padding: 2.5rem 2rem;
            text-align: center;
            transition: var(--transition-smooth);
            position: relative;
            border-radius: 8px;
            overflow: hidden;
        }

        .zona-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(200, 162, 77, 0) 0%, rgba(200, 162, 77, 0.08) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .zona-card:hover {
            transform: translateY(-4px);
        }

        .zona-card:hover::before {
            opacity: 1;
        }

        .zona-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
            font-size: 1.4rem;
            transition: transform 0.3s ease;
        }

        .zona-card:hover .zona-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .zona-label {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 0.4rem;
        }

        .zona-ciudad {
            font-size: 0.8rem;
            margin: 0;
        }

        /* ── PLATILLOS DESTACADOS - MEJORADO ── */
        .platos-section {
            padding: 100px 0;
            background: var(--color-bg-soft);
            position: relative;
        }

        .platos-section::after {
            content: '';
            position: absolute;
            bottom: -10%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(200, 162, 77, 0.03) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .platos-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        /* Grid principal - 1 destacado + 4 cards */
        .platos-destacados-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            margin-bottom: 3rem;
        }

        /* Card Insignia */
        .plato-insignia-wrapper {
            position: relative;
            z-index: 1;
        }

        .plato-card-insignia {
            background: var(--color-bg);
            border: 2px solid var(--color-gold);
            overflow: hidden;
            transition: var(--transition-smooth);
            height: 100%;
            display: flex;
            flex-direction: column;
            border-radius: 12px;
            position: relative;
            box-shadow: 0 10px 40px rgba(200, 162, 77, 0.1);
        }

        .plato-card-insignia:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(200, 162, 77, 0.2);
        }

        .plato-img-insignia {
            position: relative;
            width: 100%;
            aspect-ratio: 16 / 9;
            overflow: hidden;
            background: linear-gradient(135deg, #1a1a1a, #2d2010);
        }

        .plato-img-insignia img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .plato-card-insignia:hover .plato-img-insignia img {
            transform: scale(1.08);
        }

        .plato-insignia-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: var(--color-gold);
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            z-index: 2;
            box-shadow: 0 4px 12px rgba(200, 162, 77, 0.3);
        }

        .plato-card-body-insignia {
            padding: 2rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .plato-card-categoria {
            font-size: 0.55rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--color-gold);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .plato-card-nombre {
            font-size: 1.1rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--color-dark);
            margin-bottom: 0.75rem;
            line-height: 1.3;
        }

        .plato-card-desc {
            font-size: 0.75rem;
            color: var(--color-muted);
            line-height: 1.7;
            margin-bottom: 1.5rem;
            flex: 1;
        }

        .plato-card-footer-insignia {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1.5rem;
            border-top: 1px solid var(--color-line);
            margin-top: auto;
        }

        .plato-precio-insignia {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--color-gold);
        }

        /* Grid de 4 cards - 2 filas de 2 */
        .platos-destacados-4 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .plato-card-destacado {
            background: var(--color-bg);
            border: 1px solid var(--color-line);
            overflow: hidden;
            transition: var(--transition-smooth);
            height: 100%;
            display: flex;
            flex-direction: column;
            border-radius: 12px;
            position: relative;
        }

        .plato-card-destacado:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: var(--color-gold);
        }

        .plato-imagen-destacado {
            position: relative;
            width: 100%;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            background: var(--color-bg-soft);
        }

        .plato-imagen-destacado img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .plato-card-destacado:hover .plato-imagen-destacado img {
            transform: scale(1.08);
        }

        .plato-imagen-destacado .no-img {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f5f5f0 0%, #e8e4d8 100%);
        }

        .plato-imagen-destacado .no-img i {
            font-size: 2.5rem;
            color: var(--color-gold);
            opacity: 0.5;
        }

        .plato-card-body-destacado {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .plato-card-nombre-destacado {
            font-size: 0.9rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--color-dark);
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .plato-card-desc-destacado {
            font-size: 0.7rem;
            color: var(--color-muted);
            line-height: 1.6;
            margin-bottom: 1rem;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .plato-card-footer-destacado {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 0.5px solid var(--color-line);
            margin-top: auto;
        }

        .plato-precio {
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--color-gold);
        }

        /* ── SEDES ────────────────────────────────────── */
        .sedes-section {
            padding: 100px 0;
            background: var(--color-dark);
            position: relative;
            overflow: hidden;
        }

        .sedes-section::before {
            content: '';
            position: absolute;
            top: 50%;
            left: -20%;
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, rgba(200, 162, 77, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .sede-card {
            position: relative;
            overflow: hidden;
            height: 460px;
            cursor: pointer;
            display: block;
            text-decoration: none;
            border-radius: 12px;
            transition: var(--transition-smooth);
        }

        .sede-card-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-color: #1e1e1e;
            transition: transform 0.7s ease;
        }

        .sede-card:hover .sede-card-bg {
            transform: scale(1.08);
        }

        .sede-card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.88) 0%, rgba(0, 0, 0, 0.15) 60%);
            transition: all 0.3s ease;
        }

        .sede-card:hover .sede-card-overlay {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.92) 0%, rgba(0, 0, 0, 0.35) 60%);
        }

        .sede-card-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 2.5rem 2rem;
            z-index: 2;
        }

        .sede-zona {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--color-gold);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .sede-nombre {
            font-size: 1.8rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 0.75rem;
            color: #fff;
            transition: transform 0.3s ease;
        }

        .sede-card:hover .sede-nombre {
            transform: translateX(4px);
        }

        .sede-dir {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .sede-link-txt {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #fff;
            background: rgba(200, 162, 77, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            backdrop-filter: blur(6px);
            text-decoration: none;
            opacity: 0;
            transform: translateY(10px);
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }

        .sede-link-txt::before {
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

        .sede-card:hover .sede-link-txt {
            opacity: 1;
            transform: translateY(0);
        }

        .sede-link-txt:hover {
            color: #fff;
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.35);
            transform: translateY(-2px);
        }

        .sede-link-txt:hover::before {
            left: 0;
        }

        /* ── RESERVA ──────────────────────────────────── */
        .reserva-section {
            padding: 100px 0;
            background: var(--color-bg-soft);
            position: relative;
        }

        .reserva-section::after {
            content: '';
            position: absolute;
            bottom: -15%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(200, 162, 77, 0.04) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .reserva-form-wrap {
            background: var(--color-bg);
            border: 1px solid var(--color-line);
            padding: 2.5rem;
            border-radius: 12px;
            position: relative;
            z-index: 1;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        }

        .form-label-trp {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-muted);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-control-trp {
            width: 100%;
            padding: 12px 16px;
            border: 0.5px solid var(--color-line);
            background: var(--color-bg-soft);
            font-family: var(--font-main);
            font-size: 0.85rem;
            color: var(--color-dark);
            outline: none;
            transition: var(--transition-smooth);
            border-radius: 4px;
        }

        .form-control-trp:focus {
            border-color: var(--color-gold);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(200, 162, 77, 0.1);
        }

        /* ── FADE-IN OBSERVER ─────────────────────────── */
        .fade-in-up {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── RESPONSIVE ─────────────────────────────── */
        @media (max-width: 992px) {
            .platos-destacados-4 {
                grid-template-columns: 1fr;
            }

            .historia-numero {
                font-size: 5rem;
                margin-bottom: -0.8rem;
            }
        }

        @media (max-width: 768px) {
            .hero-ctas {
                gap: 1rem;
                flex-direction: column;
            }

            .hero-btn {
                width: 100%;
                justify-content: center;
            }

            .stats-section {
                padding: 60px 0;
            }

            .historia-section {
                padding: 80px 0;
            }

            .historia-numero {
                font-size: 4rem;
                margin-bottom: -0.5rem;
            }

            .platos-section {
                padding: 80px 0;
            }

            .plato-img-insignia {
                aspect-ratio: 16 / 10;
            }

            .sedes-section {
                padding: 80px 0;
            }

            .sede-card {
                height: 350px;
            }

            .sede-card-content {
                padding: 1.5rem 1.5rem;
            }

            .sede-nombre {
                font-size: 1.3rem;
            }

            .reserva-section {
                padding: 80px 0;
            }

            .reserva-form-wrap {
                padding: 1.5rem;
            }

            .plato-card-body-insignia {
                padding: 1.5rem;
            }

            .platos-header {
                margin-bottom: 3rem;
            }

            .platos-destacados-grid {
                gap: 1.5rem;
                margin-bottom: 2rem;
            }
        }

        @media (max-width: 576px) {
            :root {
                --font-main: 'Montserrat', sans-serif;
            }

            .hero-title {
                font-size: clamp(2rem, 7vw, 3.5rem);
            }

            .hero-label {
                font-size: 0.6rem;
            }

            .hero-subtitle {
                font-size: 0.65rem;
            }

            .section-title {
                font-size: clamp(1.4rem, 3vw, 2rem);
            }

            .plato-card-nombre-destacado {
                font-size: 0.8rem;
            }

            .plato-card-body-insignia {
                padding: 1.25rem;
            }

            .stat-number {
                font-size: clamp(1.8rem, 4vw, 2.5rem);
            }

            .stat-label {
                font-size: 0.55rem;
            }

            .plato-card-categoria {
                font-size: 0.5rem;
            }

            .hero-btn {
                padding: 12px 24px;
                font-size: 0.65rem;
            }

            .zona-card {
                padding: 1.5rem 1rem;
            }

            .sede-card-content {
                padding: 1rem 1rem;
            }

            .sede-nombre {
                font-size: 1.1rem;
            }

            .plato-price-wrapper {
                flex-wrap: wrap;
                gap: 0.5rem;
            }
        }
    </style>
@endpush

@section('content')

    {{-- ═══════════════════ HERO CON VIDEO ═══════════════════ --}}
    <section class="trp-hero">
        <div class="hero-video-wrapper">
            <video class="hero-video" autoplay loop muted playsinline poster="{{ asset('images/hero-bg.jpg') }}">
                <source src="{{ asset('videos/restaurant-ambient.mp4') }}" type="video/mp4">
                <img src="{{ asset('images/hero-bg.jpg') }}" alt="The Royale Palace">
            </video>
            <div class="hero-overlay"></div>
        </div>

        <div class="hero-content">
            <span class="hero-label">El Salvador &nbsp;·&nbsp; Tres Sedes &nbsp;·&nbsp; Una Experiencia</span>
            <h1 class="hero-title">The <span>Royale</span><br>Palace</h1>
            <div class="hero-divider"></div>
            <p class="hero-subtitle">
                Sabores auténticos de El Salvador<br>
                elevados a una experiencia premium
            </p>
            <div class="hero-ctas">
                <a href="{{ route('reservaciones.create') }}" class="hero-btn hero-btn-primary">
                    <i class="bi bi-calendar-check"></i>Reservar Mesa
                </a>
                <a href="{{ route('menu.index') }}" class="hero-btn hero-btn-secondary">
                    <i class="bi bi-book"></i> Explorar Menú
                </a>
            </div>
        </div>

        <div class="hero-scroll" onclick="document.querySelector('.stats-section').scrollIntoView({ behavior: 'smooth' })">
            <span>Descubrir</span>
            <i class="bi bi-chevron-down" style="font-size:1rem;"></i>
        </div>
    </section>

    {{-- ═══════════════════ STATS ══════════════════ --}}
    <section class="stats-section">
        <div class="container">
            <div class="row justify-content-center text-center g-4">
                <div class="col-6 col-md-3 fade-in-up">
                    <div class="stat-item">
                        <div class="stat-number">3</div>
                        <div class="stat-label">Sedes en el País</div>
                    </div>
                </div>
                <div class="col-6 col-md-3 fade-in-up" style="transition-delay:0.1s">
                    <div class="stat-item">
                        <div class="stat-number">30+</div>
                        <div class="stat-label">Platillos Exclusivos</div>
                    </div>
                </div>
                <div class="col-6 col-md-3 fade-in-up" style="transition-delay:0.2s">
                    <div class="stat-item">
                        <div class="stat-number">45</div>
                        <div class="stat-label">Mesas Disponibles</div>
                    </div>
                </div>
                <div class="col-6 col-md-3 fade-in-up" style="transition-delay:0.3s">
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Sabor Salvadoreño</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════ HISTORIA ═══════════════ --}}
    <section class="historia-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5 fade-in-up">
                    <div class="historia-numero">2024</div>
                    <br>
                    <p class="section-label">Nuestra Historia</p>
                    <h2 class="section-title">TRADICIÓN<br>Y ELEGANCIA</h2>
                    <div class="gold-divider"></div>
                    <p class="section-subtitle mt-3">
                        Nacimos del amor profundo por la cocina salvadoreña y el deseo de presentarla al mundo con
                        la distinción que merece. Ingredientes locales de primera calidad, técnicas contemporáneas y una
                        pasión auténtica por la cultura nacional.
                    </p>
                    <p class="section-subtitle mt-3">
                        Tres sedes, una sola misión: que cada visita sea una celebración de lo que significa ser
                        salvadoreño.
                    </p>
                    <a href="{{ route('nosotros') }}" class="btn-outline-gold mt-4">
                        <i class="bi bi-arrow-right-circle"></i> Conocer Más
                    </a>
                </div>

                <div class="col-lg-7 fade-in-up" style="transition-delay:0.15s">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="zona-card" style="background:var(--color-bg-soft);border:0.5px solid var(--color-line);">
                                <div class="zona-icon" style="background:#F0F0F0;">
                                    <i class="bi bi-geo-alt-fill" style="color:var(--color-green);font-size:1.3rem;"></i>
                                </div>
                                <p class="zona-label" style="color:var(--color-dark);">Zona Occidente</p>
                                <p class="zona-ciudad" style="color:var(--color-muted);">Santa Ana</p>
                            </div>
                        </div>
                        <div class="col-6" style="margin-top:2rem;">
                            <div class="zona-card" style="background:var(--color-dark);">
                                <div class="zona-icon" style="background:rgba(255,255,255,0.08);">
                                    <i class="bi bi-building" style="color:var(--color-gold);font-size:1.3rem;"></i>
                                </div>
                                <p class="zona-label" style="color:rgba(255,255,255,0.5);">Zona Central</p>
                                <p class="zona-ciudad" style="color:#fff;">San Salvador</p>
                            </div>
                        </div>
                        <div class="col-6" style="margin-top:-1rem;">
                            <div class="zona-card" style="background:var(--color-gold);">
                                <div class="zona-icon" style="background:rgba(255,255,255,0.15);">
                                    <i class="bi bi-water" style="color:#fff;font-size:1.3rem;"></i>
                                </div>
                                <p class="zona-label" style="color:rgba(255,255,255,0.7);">Zona Oriente</p>
                                <p class="zona-ciudad" style="color:#fff;">San Miguel</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════ PLATILLOS DESTACADOS - MEJORADO ═══════════════════ --}}
    <section class="platos-section">
        <div class="container">
            <div class="platos-header fade-in-up">
                <p class="section-label">Alta Gastronomía Salvadoreña</p>
                <h2 class="section-title">PLATILLOS DESTACADOS</h2>
                <div class="gold-divider mx-auto" style="margin:1rem auto;"></div>
            </div>

            {{-- Plato Insignia --}}
            <div class="platos-destacados-grid">
                <div class="plato-insignia-wrapper fade-in-up">
                    <div class="plato-card-insignia">
                        <div class="plato-img-insignia">
                            <img src="{{ asset('images/platos/royal-cuscatlan.jpg') }}" alt="Royal Cuscatlán">
                            <div class="plato-insignia-badge">
                                <i class="bi bi-award"></i> Insignia
                            </div>
                        </div>
                        <div class="plato-card-body-insignia">
                            <p class="plato-card-categoria">
                                <i class="bi bi-pin-map"></i> Disponible en las 3 sedes
                            </p>
                            <h3 class="plato-card-nombre">Royal Cuscatlán</h3>
                            <p class="plato-card-desc">
                                Un homenaje a la riqueza culinaria salvadoreña. Combina ingredientes emblemáticos de
                                Occidente, Centro y Oriente en una experiencia gastronómica única e irrepetible.
                            </p>
                            <div class="plato-card-footer-insignia">
                                <span class="plato-precio-insignia">$24.00</span>
                                <a href="{{ route('menu.sede', 'san-salvador') }}" class="btn-gold">
                                    Explorar <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Platos Destacados Grid 2x2 --}}
            <div class="platos-destacados-4">
                @php
                    $destacados = [
                        [
                            'nombre' => 'Pupusa Royale',
                            'precio' => '8.50',
                            'sede' => 'santa-ana',
                            'zona' => 'Occidente · Santa Ana',
                            'desc' => 'Pupusa artesanal de quesillo ahumado y chicharrón premium.',
                            'img' => 'pupusa-royale.jpg'
                        ],
                        [
                            'nombre' => 'Mariscada Bahía',
                            'precio' => '19.00',
                            'sede' => 'san-miguel',
                            'zona' => 'Oriente · San Miguel',
                            'desc' => 'Camarones, pescado y moluscos frescos del Golfo de Fonseca.',
                            'img' => 'mariscada.jpg'
                        ],
                        [
                            'nombre' => 'Costilla Santa Ana',
                            'precio' => '14.00',
                            'sede' => 'santa-ana',
                            'zona' => 'Occidente · Santa Ana',
                            'desc' => 'Costilla marinada 24 horas en especias salvadoreñas.',
                            'img' => 'costilla.jpg'
                        ],
                        [
                            'nombre' => 'Filete Costero',
                            'precio' => '16.00',
                            'sede' => 'san-salvador',
                            'zona' => 'Centro · San Salvador',
                            'desc' => 'Pescado fresco con vegetales asados y salsa de hierbas.',
                            'img' => 'filete-costero.jpg'
                        ],
                    ];
                @endphp

                @foreach($destacados as $item)
                    <div class="fade-in-up">
                        <div class="plato-card-destacado">
                            <div class="plato-imagen-destacado">
                                @if(file_exists(public_path('images/platos/' . $item['img'])))
                                    <img src="{{ asset('images/platos/' . $item['img']) }}" alt="{{ $item['nombre'] }}">
                                @else
                                    <div class="no-img">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="plato-card-body-destacado">
                                <p class="plato-card-categoria">
                                    <i class="bi bi-geo-alt-fill"></i> {{ $item['zona'] }}
                                </p>
                                <h3 class="plato-card-nombre-destacado">{{ $item['nombre'] }}</h3>
                                <p class="plato-card-desc-destacado">{{ $item['desc'] }}</p>
                                <div class="plato-card-footer-destacado">
                                    <span class="plato-precio">${{ number_format($item['precio'], 2) }}</span>
                                    <a href="{{ route('menu.sede', $item['sede']) }}" class="btn-gold" style="padding: 8px 16px; font-size: 0.6rem;">
                                        Ver <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- CTA Ver Menú --}}
            <div class="text-center fade-in-up">
                <a href="{{ route('menu.index') }}" class="btn-outline-gold">
                    <i class="bi bi-book-half"></i> Ver Menú Completo
                </a>
            </div>
        </div>
    </section>

    {{-- ═══════════════════ SEDES ══════════════════ --}}
    <section class="sedes-section">
        <div class="container">
            <div class="text-center mb-5 fade-in-up">
                <p class="section-label" style="color:rgba(255,255,255,0.35);">Encuéntranos</p>
                <h2 class="section-title" style="color:#fff;">NUESTRAS SEDES</h2>
                <div class="gold-divider mx-auto" style="margin:1rem auto;"></div>
            </div>
        </div>

        <div class="container-fluid px-0">
            <div class="row g-0">
                @php
                    $sedesInfo = [
                        'san-salvador' => [
                            'bg' => asset('images/sedes/san-salvador.png'),
                            'zona' => 'Zona Central'
                        ],
                        'santa-ana' => [
                            'bg' => asset('images/sedes/santa-ana.png'),
                            'zona' => 'Zona Occidente'
                        ],
                        'san-miguel' => [
                            'bg' => asset('images/sedes/san-miguel.png'),
                            'zona' => 'Zona Oriente'
                        ],
                    ];
                @endphp

                @foreach($sedes as $sede)
                    @php $info = $sedesInfo[$sede->slug] ?? ['bg' => '', 'zona' => $sede->zona ?? '']; @endphp
                    <div class="col-12 col-md-4">
                        <a href="{{ route('menu.sede', $sede->slug) }}" class="sede-card fade-in-up">
                            <div class="sede-card-bg" style="background-image:url('{{ $info['bg'] }}');"></div>
                            <div class="sede-card-overlay"></div>
                            <div class="sede-card-content">
                                <p class="sede-zona">
                                    <i class="bi bi-geo-alt-fill"></i>{{ $info['zona'] }}
                                </p>
                                <h3 class="sede-nombre">{{ $sede->nombre }}</h3>
                                <p class="sede-dir">
                                    <i class="bi bi-map"></i>{{ $sede->direccion }}
                                </p>
                                <span class="sede-link-txt">
                                    Ver Menú <i class="bi bi-arrow-right"></i>
                                </span>
                            </div>
                        </a>
                    </div>
                    <br>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════ RESERVACIÓN ════════════ --}}
    <section class="reserva-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5 fade-in-up">
                    <p class="section-label">Reserva en Línea</p>
                    <h2 class="section-title">ASEGURA<br>TU MESA</h2>
                    <div class="gold-divider"></div>
                    <p class="section-subtitle mt-3">
                        Elige tu sede, fecha y hora. Tu experiencia en The Royale Palace comienza desde el momento en que
                        reservas.
                    </p>
                    <div class="mt-4 d-flex flex-column gap-3">
                        <div style="display:flex;align-items:center;gap:1rem;">
                            <div style="width:40px;height:40px;background:var(--color-bg-soft);
                                        border:0.5px solid var(--color-line);display:flex;
                                        align-items:center;justify-content:center;flex-shrink:0;border-radius:4px;">
                                <i class="bi bi-clock" style="color:var(--color-gold);"></i>
                            </div>
                            <div>
                                <p style="font-size:0.6rem;font-weight:700;letter-spacing:2px;
                                          color:var(--color-muted);text-transform:uppercase;margin:0;">Horario</p>
                                <p style="font-size:0.85rem;font-weight:600;color:var(--color-dark);margin:0;">
                                    Lun – Dom · 11:00am – 10:00pm
                                </p>
                            </div>
                        </div>

                        <div style="display:flex;align-items:center;gap:1rem;">
                            <div style="width:40px;height:40px;background:var(--color-bg-soft);
                                        border:0.5px solid var(--color-line);display:flex;
                                        align-items:center;justify-content:center;flex-shrink:0;border-radius:4px;">
                                <i class="bi bi-telephone" style="color:var(--color-gold);"></i>
                            </div>
                            <div>
                                <p style="font-size:0.6rem;font-weight:700;letter-spacing:2px;
                                          color:var(--color-muted);text-transform:uppercase;margin:0;">Teléfono</p>
                                <p style="font-size:0.85rem;font-weight:600;color:var(--color-dark);margin:0;">
                                    +503 2200-0000
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 fade-in-up" style="transition-delay:0.15s">
                    <div class="reserva-form-wrap">
                        <p style="font-size:1rem;font-weight:700;letter-spacing:3px;
                                   text-transform:uppercase;color:var(--color-gold);margin-bottom:2rem;
                                   display:flex;align-items:center;gap:8px;">
                            <i class="bi bi-calendar3"></i> Formulario de Reservación
                        </p>

                        @guest
                            <div style="text-align:center;padding:2rem 0;">
                                <i class="bi bi-lock" style="font-size:2.5rem;color:var(--color-line);display:block;margin-bottom:1rem;"></i>
                                <p style="color:var(--color-muted);font-size:0.85rem;margin-bottom:1.5rem;">
                                    Inicia sesión para realizar tu reservación
                                </p>
                                <a href="{{ route('login') }}" class="btn-gold">
                                    <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                                </a>
                            </div>
                        @else
                            <form action="{{ route('reservaciones.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label-trp">
                                            <i class="bi bi-geo-alt"></i>Sede
                                        </label>
                                        <select name="sede_id" class="form-control-trp" required>
                                            <option value="">Selecciona una sede</option>
                                            @foreach($sedes as $sede)
                                                <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-trp">
                                            <i class="bi bi-people"></i>Personas
                                        </label>
                                        <select name="num_personas" class="form-control-trp" required>
                                            @for($i = 1; $i <= 8; $i++)
                                                <option value="{{ $i }}">{{ $i }} persona{{ $i > 1 ? 's' : '' }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-trp">
                                            <i class="bi bi-calendar3"></i>Fecha
                                        </label>
                                        <input type="date" name="fecha" class="form-control-trp"
                                               min="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-trp">
                                            <i class="bi bi-clock"></i>Hora
                                        </label>
                                        <select name="hora" class="form-control-trp" required>
                                            @foreach([
                                                    '11:00',
                                                    '11:30',
                                                    '12:00',
                                                    '12:30',
                                                    '13:00',
                                                    '13:30',
                                                    '14:00',
                                                    '14:30',
                                                    '18:00',
                                                    '18:30',
                                                    '19:00',
                                                    '19:30',
                                                    '20:00',
                                                    '20:30',
                                                    '21:00',
                                                    '21:30'
                                                ] as $h)
                                                    <option value="{{ $h }}">{{ $h }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label-trp">
                                            <i class="bi bi-chat-left-text"></i>Notas especiales (opcional)
                                        </label>
                                        <textarea name="notas" class="form-control-trp" rows="3"
                                                  placeholder="Alergias, celebraciones, preferencias..."></textarea>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <button type="submit" class="btn-gold w-100" style="justify-content:center;">
                                            <i class="bi bi-calendar-check"></i> Confirmar Reservación
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════ CTA FINAL ══════════════ --}}
    <section style="padding:100px 0;background:var(--color-dark);text-align:center;position:relative;overflow:hidden;">
        <div style="position:absolute;top:50%;right:-15%;width:600px;height:600px;background:radial-gradient(circle,rgba(200,162,77,0.06) 0%,transparent 70%);border-radius:50%;transform:translateY(-50%);pointer-events:none;"></div>
        <div class="container" style="position:relative;z-index:1;">
            <div class="fade-in-up">
                <p class="section-label" style="color:rgba(255,255,255,0.25);">Una Experiencia Única</p>
                <h2 class="section-title" style="color:#fff;font-size:clamp(2rem,5vw,4rem);">
                    VIVE THE ROYALE<br><span style="color:var(--color-gold);">PALACE</span>
                </h2>
                <div class="gold-divider mx-auto my-4"></div>
                <p style="color:rgba(255,255,255,0.45);font-size:0.85rem;max-width:480px;
                          margin:0 auto 3rem;line-height:2;">
                    Tres sedes. Platillos exclusivos por región. Una gastronomía salvadoreña que celebra su identidad
                    con elegancia y distinción.
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('reservaciones.create') }}" class="btn-gold">
                        <i class="bi bi-calendar-check"></i> Reservar Ahora
                    </a>
                    <a href="{{ route('sucursales') }}"
                       style="display:inline-flex;align-items:center;gap:8px;padding:14px 36px;
                              background:transparent;color:rgba(255,255,255,0.6);
                              font-family:var(--font-main);font-size:0.7rem;font-weight:700;
                              letter-spacing:3px;text-transform:uppercase;text-decoration:none;
                              border:1.5px solid rgba(255,255,255,0.15);transition:var(--transition-smooth);
                              border-radius:4px;"
                       onmouseover="this.style.borderColor='var(--color-gold)';this.style.color='var(--color-gold)'"
                       onmouseout="this.style.borderColor='rgba(255,255,255,0.15)';this.style.color='rgba(255,255,255,0.6)'">
                        <i class="bi bi-geo-alt"></i> Ver Sucursales
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.querySelector('.hero-video');
            if (video) {
                video.play().catch(e => console.log('Autoplay prevented:', e));
            }
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));
    </script>
@endpush
