<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            width: 100%;
        }

        body {
            font-family: 'Segoe UI', 'Arial', sans-serif;
            font-size: 11px;
            color: #222;
            background: #ffffff;
            line-height: 1.5;
        }

        /* ── HEADER ────────────────────────────────────── */
        .header {
            background: #111111;
            padding: 30px 40px;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .logo-container {
            width: 70px;
            height: 70px;
            flex-shrink: 0;
        }

        .logo-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .header-content {
            flex: 1;
        }

        .header-title {
            font-size: 20px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .header-subtitle {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.7);
            letter-spacing: 1px;
            text-transform: uppercase;
            font-weight: 500;
        }

        /* ── INFO SECTION ────────────────────────────── */
        .info-section {
            padding: 20px 40px;
            background: #f5f5f5;
            margin-bottom: 30px;
            border-left: 4px solid #C8A24D;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #888;
            margin-bottom: 6px;
        }

        .info-value {
            font-size: 13px;
            font-weight: 600;
            color: #222;
        }

        /* ── SUMMARY BOXES ────────────────────────────── */
        .summary-section {
            padding: 0 40px;
            margin-bottom: 40px;
        }

        .summary-title {
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #111;
            margin-bottom: 20px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
        }

        .summary-box {
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-top: 3px solid #C8A24D;
            padding: 20px;
            text-align: center;
            border-radius: 6px;
        }

        .summary-box.confirmed {
            border-top-color: #27AE60;
        }

        .summary-box.completed {
            border-top-color: #1E8449;
        }

        .summary-box.pending {
            border-top-color: #F39C12;
        }

        .summary-box.cancelled {
            border-top-color: #E74C3C;
        }

        .summary-box.total {
            border-top-color: #305D42;
            background: #f9f9f9;
        }

        .summary-number {
            font-size: 32px;
            font-weight: 800;
            color: #C8A24D;
            line-height: 1;
            margin-bottom: 8px;
        }

        .summary-box.confirmed .summary-number {
            color: #27AE60;
        }

        .summary-box.completed .summary-number {
            color: #1E8449;
        }

        .summary-box.pending .summary-number {
            color: #F39C12;
        }

        .summary-box.cancelled .summary-number {
            color: #E74C3C;
        }

        .summary-box.total .summary-number {
            color: #305D42;
        }

        .summary-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #666;
        }

        /* ── TABLE ────────────────────────────────────── */
        .table-section {
            padding: 0 40px;
            margin-bottom: 40px;
        }

        .table-title {
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #111;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border: 1px solid #e0e0e0;
        }

        thead {
            background: #111111;
        }

        thead th {
            color: #ffffff;
            padding: 15px 12px;
            text-align: left;
            font-size: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-weight: 700;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        thead th:last-child {
            border-right: none;
        }

        tbody td {
            padding: 14px 12px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 11px;
        }

        tbody tr:hover {
            background: #f9f9f9;
        }

        tbody tr:nth-child(even) {
            background: #fafafa;
        }

        tbody tr:nth-child(even):hover {
            background: #f5f5f5;
        }

        /* ── CELL STYLES ────────────────────────────– */
        .code {
            font-family: 'Courier New', monospace;
            font-weight: 700;
            color: #C8A24D;
            font-size: 10px;
            letter-spacing: 0.5px;
        }

        .client-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .client-name {
            font-weight: 700;
            color: #222;
        }

        .client-email {
            color: #888;
            font-size: 10px;
        }

        .center {
            text-align: center;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .badge-confirmed {
            background: #D4EDDA;
            color: #155724;
        }

        .badge-completed {
            background: #C3E6CB;
            color: #0C5460;
        }

        .badge-pending {
            background: #FFF3CD;
            color: #856404;
        }

        .badge-cancelled {
            background: #F8D7DA;
            color: #721C24;
        }

        /* ── FOOTER ────────────────────────────────────– */
        .footer {
            padding: 20px 40px;
            text-align: center;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #e0e0e0;
            margin-top: 50px;
        }

        /* ── DIVIDER ────────────────────────────────── */
        .divider {
            height: 1px;
            background: #e0e0e0;
            margin: 30px 40px;
        }

        /* ── PRINT STYLES ──────────────────────────── */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .header {
                page-break-after: avoid;
            }

            .table-section {
                page-break-inside: avoid;
            }

            table {
                page-break-inside: avoid;
            }

            thead {
                display: table-header-group;
            }

            .footer {
                position: static;
            }
        }

        /* ── RESPONSIVE ─────────────────────────────– */
        @media (max-width: 900px) {
            .info-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .summary-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 10px;
            }

            .summary-box {
                padding: 15px;
            }

            .summary-number {
                font-size: 26px;
            }
        }

        @media (max-width: 600px) {
            .header {
                padding: 20px;
                gap: 15px;
            }

            .logo-container {
                width: 60px;
                height: 60px;
            }

            .header-title {
                font-size: 16px;
            }

            .info-section {
                padding: 15px 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .summary-section {
                padding: 0 20px;
            }

            .summary-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .summary-number {
                font-size: 22px;
            }

            .table-section {
                padding: 0 20px;
                overflow-x: auto;
            }

            table {
                font-size: 9px;
            }

            thead th {
                padding: 10px 8px;
                font-size: 8px;
            }

            tbody td {
                padding: 10px 8px;
            }

            .divider {
                margin: 20px;
            }

            .footer {
                padding: 15px 20px;
            }
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="header">
        <div class="logo-container">
            <img src="{{ asset('images/logo-b.png') }}" alt="The Royale Palace">
        </div>
        <div class="header-content">
            <div class="header-title">The Royale Palace</div>
            <div class="header-subtitle">Reporte de Reservaciones</div>
        </div>
    </div>

    {{-- INFO SECTION --}}
    <div class="info-section">
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Período</div>
                <div class="info-value">{{ \Carbon\Carbon::create()->month($mes)->locale('es')->monthName }} {{ $anio }}
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Sede</div>
                <div class="info-value">{{ $sedeSeleccionada ? $sedeSeleccionada->nombre : 'Todas las sedes' }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Total de Registros</div>
                <div class="info-value">{{ $reservaciones->count() }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Fecha de Generación</div>
                <div class="info-value">{{ now()->format('d/m/Y H:i') }}</div>
            </div>
        </div>
    </div>

    {{-- SUMMARY SECTION --}}
    <div class="summary-section">
        <div class="summary-title">Resumen de Reservaciones</div>

        @php
            $confirmadas = $reservaciones->where('estado', 'confirmada')->count();
            $completadas = $reservaciones->where('estado', 'completada')->count();
            $canceladas = $reservaciones->where('estado', 'cancelada')->count();
            $pendientes = $reservaciones->where('estado', 'pendiente')->count();
        @endphp

        <div class="summary-grid">
            <div class="summary-box pending">
                <div class="summary-number">{{ $pendientes }}</div>
                <div class="summary-label">Pendientes</div>
            </div>
            <div class="summary-box confirmed">
                <div class="summary-number">{{ $confirmadas }}</div>
                <div class="summary-label">Confirmadas</div>
            </div>
            <div class="summary-box completed">
                <div class="summary-number">{{ $completadas }}</div>
                <div class="summary-label">Completadas</div>
            </div>
            <div class="summary-box cancelled">
                <div class="summary-number">{{ $canceladas }}</div>
                <div class="summary-label">Canceladas</div>
            </div>
            <div class="summary-box total">
                <div class="summary-number">{{ $reservaciones->count() }}</div>
                <div class="summary-label">Total</div>
            </div>
        </div>
    </div>

    <div class="divider"></div>

    {{-- TABLE SECTION --}}
    <div class="table-section">
        <div class="table-title">Detalle de Reservaciones</div>

        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Cliente</th>
                    <th>Sede</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th class="center">Mesa</th>
                    <th class="center">Personas</th>
                    <th class="center">Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservaciones as $res)
                    <tr>
                        <td>
                            <span class="code">{{ $res->codigo }}</span>
                        </td>
                        <td>
                            <div class="client-info">
                                <span class="client-name">{{ $res->user->name }}</span>
                                <span class="client-email">{{ $res->user->email }}</span>
                            </div>
                        </td>
                        <td>{{ $res->sede->nombre }}</td>
                        <td>{{ $res->fecha->format('d/m/Y') }}</td>
                        <td>{{ $res->hora }}</td>
                        <td class="center"><strong>#{{ $res->mesa->numero }}</strong></td>
                        <td class="center"><strong>{{ $res->num_personas }}</strong></td>
                        <td class="center">
                            @php
                                $estadoClass = match ($res->estado) {
                                    'confirmada' => 'badge-confirmed',
                                    'completada' => 'badge-completed',
                                    'pendiente' => 'badge-pending',
                                    'cancelada' => 'badge-cancelled',
                                    default => 'badge-pending'
                                };
                            @endphp
                            <span class="badge {{ $estadoClass }}">{{ ucfirst($res->estado) }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 30px; color: #999;">
                            No hay reservaciones registradas para este período
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        The Royale Palace — Reporte Confidencial — Generado {{ now()->format('d/m/Y \\a \\l\\a\\s H:i') }}
    </div>

</body>

</html>