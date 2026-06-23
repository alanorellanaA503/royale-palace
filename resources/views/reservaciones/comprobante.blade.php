<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante {{ $reservacion->codigo }} — The Royale Palace</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --gold: #C8A24D;
            --dark: #111111;
            --muted: #555555;
            --line: #E5E5E5;
            --green: #305D42;
            --font: 'Montserrat', sans-serif;
        }

        * { margin:0; padding:0; box-sizing:border-box; }

        body {
            font-family: var(--font);
            background: #F4F5F7;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem;
        }

        .comprobante-wrapper {
            width: 100%;
            max-width: 640px;
        }

        /* Botones de acción - solo pantalla */
        .action-bar {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            justify-content: space-between;
            align-items: center;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 20px;
            background: transparent;
            border: 1px solid var(--line);
            border-radius: 6px;
            font-family: var(--font);
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--muted);
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-back:hover { border-color: var(--dark); color: var(--dark); }

        .btn-print {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 24px;
            background: var(--gold);
            border: none;
            border-radius: 6px;
            font-family: var(--font);
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #fff;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-print:hover { background: #A8862C; transform: translateY(-1px); }

        /* Tarjeta del comprobante */
        .comprobante {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        }

        /* Header dorado */
        .comp-header {
            background: var(--dark);
            padding: 2.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .comp-header::before {
            content: '';
            position: absolute;
            top: -30%; right: -10%;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(200,162,77,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        .comp-logo {
            width: 56px; height: 56px;
            object-fit: contain;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .comp-brand {
            font-size: 1.1rem;
            font-weight: 800;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: #fff;
            position: relative;
            z-index: 1;
        }

        .comp-brand span { color: var(--gold); }

        .comp-tagline {
            font-size: 0.6rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.4);
            margin-top: 0.25rem;
            position: relative;
            z-index: 1;
        }

        /* Badge de confirmación */
        .comp-status {
            background: var(--gold);
            color: #fff;
            text-align: center;
            padding: 0.75rem;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .comp-status.cancelada { background: #E53935; }
        .comp-status.pendiente { background: #F57C00; }
        .comp-status.completada { background: var(--green); }

        /* Código de reservación */
        .comp-codigo {
            text-align: center;
            padding: 2rem;
            border-bottom: 1px solid var(--line);
        }

        .codigo-label {
            font-size: 0.55rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 0.5rem;
        }

        .codigo-valor {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: 6px;
            color: var(--gold);
            font-family: 'Courier New', monospace;
        }

        /* Detalles */
        .comp-detalles {
            padding: 2rem;
        }

        .detalles-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        .detalle-item {
            padding: 1rem;
            background: #F8F8F8;
            border-radius: 8px;
            border-left: 3px solid var(--gold);
        }

        .detalle-item.full {
            grid-column: 1 / -1;
        }

        .detalle-label {
            font-size: 0.55rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 0.4rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .detalle-label i { color: var(--gold); }

        .detalle-valor {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.4;
        }

        .detalle-sub {
            font-size: 0.75rem;
            color: var(--muted);
            margin-top: 0.2rem;
        }

        /* Cliente */
        .comp-cliente {
            padding: 0 2rem 2rem;
        }

        .cliente-card {
            background: var(--dark);
            border-radius: 10px;
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .cliente-avatar {
            width: 44px; height: 44px;
            border-radius: 50%;
            background: var(--gold);
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; font-weight: 800; color: #fff;
            flex-shrink: 0;
        }

        .cliente-nombre {
            font-size: 0.9rem;
            font-weight: 700;
            color: #fff;
        }

        .cliente-email {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.45);
            margin-top: 0.15rem;
        }

        /* Notas */
        .comp-notas {
            padding: 0 2rem 2rem;
        }

        .notas-box {
            background: rgba(200,162,77,0.07);
            border: 1px solid rgba(200,162,77,0.25);
            border-radius: 8px;
            padding: 1rem 1.25rem;
        }

        .notas-titulo {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .notas-texto {
            font-size: 0.82rem;
            color: var(--muted);
            line-height: 1.6;
        }

        /* Footer */
        .comp-footer {
            background: #F8F8F8;
            border-top: 1px solid var(--line);
            padding: 1.5rem 2rem;
            text-align: center;
        }

        .footer-aviso {
            font-size: 0.7rem;
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 0.75rem;
        }

        .footer-contacto {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 1px;
            color: var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .footer-contacto span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* QR decorativo */
        .comp-qr {
            display: flex;
            justify-content: center;
            padding: 1.5rem 2rem 0;
        }

        .qr-box {
            border: 2px dashed var(--line);
            border-radius: 8px;
            padding: 1rem 1.5rem;
            text-align: center;
            display: inline-flex;
            align-items: center;
            gap: 1rem;
        }

        .qr-icon {
            font-size: 2.5rem;
            color: var(--line);
        }

        .qr-info {
            text-align: left;
        }

        .qr-info p {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 1px;
            color: var(--muted);
        }

        .qr-info span {
            font-size: 0.6rem;
            color: var(--line);
            letter-spacing: 1px;
        }

        /* ── ESTILOS DE IMPRESIÓN ── */
        @media print {
            body {
                background: #fff;
                padding: 0;
            }

            .action-bar { display: none !important; }

            .comprobante {
                box-shadow: none;
                border-radius: 0;
                border: 1px solid #ccc;
            }

            .comp-header::before { display: none; }
        }
    </style>
</head>
<body>

<div class="comprobante-wrapper">

    {{-- Barra de acciones (solo pantalla) --}}
    <div class="action-bar">
        <a href="{{ route('cuenta.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Mis Reservaciones
        </a>
        <button onclick="window.print()" class="btn-print">
            <i class="bi bi-printer"></i> Imprimir Comprobante
        </button>
    </div>

    {{-- Comprobante --}}
    <div class="comprobante">

        {{-- Header --}}
        <div class="comp-header">
            <img src="{{ asset('images/logo-b.png') }}" class="comp-logo" alt="TRP"
                 onerror="this.style.display='none'">
            <div class="comp-brand">The <span>Royale</span> Palace</div>
            <div class="comp-tagline">Comprobante de Reservación</div>
        </div>

        {{-- Estado --}}
        <div class="comp-status {{ $reservacion->estado }}">
            @switch($reservacion->estado)
                @case('confirmada')
                    <i class="bi bi-check-circle-fill"></i> Reservación Confirmada
                    @break
                @case('pendiente')
                    <i class="bi bi-clock-fill"></i> Reservación Pendiente de Confirmación
                    @break
                @case('cancelada')
                    <i class="bi bi-x-circle-fill"></i> Reservación Cancelada
                    @break
                @case('completada')
                    <i class="bi bi-star-fill"></i> Reservación Completada
                    @break
            @endswitch
        </div>

        {{-- Código --}}
        <div class="comp-codigo">
            <div class="codigo-label">Código de Reservación</div>
            <div class="codigo-valor">{{ $reservacion->codigo }}</div>
        </div>

        {{-- Detalles --}}
        <div class="comp-detalles">
            <div class="detalles-grid">
                <div class="detalle-item">
                    <div class="detalle-label">
                        <i class="bi bi-geo-alt-fill"></i> Sede
                    </div>
                    <div class="detalle-valor">{{ $reservacion->sede->nombre }}</div>
                    <div class="detalle-sub">Zona {{ $reservacion->sede->zona }}</div>
                </div>

                <div class="detalle-item">
                    <div class="detalle-label">
                        <i class="bi bi-table"></i> Mesa
                    </div>
                    <div class="detalle-valor">{{ $reservacion->mesa->numero }}</div>
                    <div class="detalle-sub">
                        {{ $reservacion->mesa->capacidad }} personas ·
                        {{ ucfirst($reservacion->mesa->ubicacion) }}
                    </div>
                </div>

                <div class="detalle-item">
                    <div class="detalle-label">
                        <i class="bi bi-calendar3"></i> Fecha
                    </div>
                    <div class="detalle-valor">
                        {{ $reservacion->fecha->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
                    </div>
                </div>

                <div class="detalle-item">
                    <div class="detalle-label">
                        <i class="bi bi-clock"></i> Hora
                    </div>
                    <div class="detalle-valor">{{ $reservacion->hora }}</div>
                    <div class="detalle-sub">Hora local El Salvador</div>
                </div>

                <div class="detalle-item">
                    <div class="detalle-label">
                        <i class="bi bi-people-fill"></i> Personas
                    </div>
                    <div class="detalle-valor">{{ $reservacion->num_personas }}</div>
                    <div class="detalle-sub">
                        {{ $reservacion->num_personas == 1 ? 'persona' : 'personas' }}
                    </div>
                </div>

                <div class="detalle-item">
                    <div class="detalle-label">
                        <i class="bi bi-calendar-check"></i> Reservado el
                    </div>
                    <div class="detalle-valor">
                        {{ $reservacion->created_at->format('d/m/Y') }}
                    </div>
                    <div class="detalle-sub">{{ $reservacion->created_at->format('H:i') }}</div>
                </div>

                <div class="detalle-item full">
                    <div class="detalle-label">
                        <i class="bi bi-map"></i> Dirección de la Sede
                    </div>
                    <div class="detalle-valor">{{ $reservacion->sede->direccion }}</div>
                    <div class="detalle-sub">{{ $reservacion->sede->telefono }}</div>
                </div>
            </div>
        </div>

        {{-- Notas especiales --}}
        @if($reservacion->notas)
        <div class="comp-notas">
            <div class="notas-box">
                <div class="notas-titulo">
                    <i class="bi bi-chat-left-text"></i> Notas Especiales
                </div>
                <div class="notas-texto">{{ $reservacion->notas }}</div>
            </div>
        </div>
        @endif

        {{-- Datos del cliente --}}
        <div class="comp-cliente">
            <div class="cliente-card">
                <div class="cliente-avatar">
                    {{ strtoupper(substr($reservacion->user->name, 0, 1)) }}
                </div>
                <div>
                    <div class="cliente-nombre">{{ $reservacion->user->name }}</div>
                    <div class="cliente-email">{{ $reservacion->user->email }}</div>
                </div>
                <div style="margin-left:auto;text-align:right;">
                    <div style="font-size:0.55rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.3);">
                        Reservación
                    </div>
                    <div style="font-size:0.75rem;font-weight:700;color:var(--gold);font-family:monospace;letter-spacing:2px;">
                        {{ $reservacion->codigo }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Decorativo tipo código QR --}}
        <div class="comp-qr">
            <div class="qr-box">
                <i class="bi bi-upc-scan qr-icon"></i>
                <div class="qr-info">
                    <p>Presenta este comprobante en el restaurante</p>
                    <span>{{ $reservacion->codigo }} · {{ $reservacion->sede->nombre }}</span>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="comp-footer">
            <p class="footer-aviso">
                Este comprobante es válido como confirmación de su reservación.<br>
                Por favor preséntelo al llegar al restaurante. Recomendamos llegar 10 minutos antes.
            </p>
            <div class="footer-contacto">
                <span><i class="bi bi-envelope"></i> reservaciones@theroyalepalace.sv</span>
                <span><i class="bi bi-telephone"></i> +503 2200-0000</span>
                <span><i class="bi bi-globe"></i> theroyalepalace.sv</span>
            </div>
        </div>

    </div>
</div>

</body>
</html>