@extends('layouts.app')

@section('title', 'Reservar Mesa — The Royale Palace')

@push('styles')
    <style>
    /* ── HERO ────────────────────────────────────── */
    .reserva-hero {
        padding: 80px 0 60px;
        background: linear-gradient(135deg, var(--color-bg-soft) 0%, var(--color-bg) 100%);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .reserva-hero::before {
        content: '';
        position: absolute;
        top: -40%; right: -10%;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(200,162,77,0.05) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    /* ── STEPS ───────────────────────────────────── */
    .steps-bar {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0;
        margin-bottom: 3rem;
    }

    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        position: relative;
    }

    .step-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid var(--color-line);
        background: var(--color-bg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--color-muted);
        transition: all 0.3s ease;
        z-index: 1;
    }

    .step.active .step-circle {
        border-color: var(--color-gold);
        background: var(--color-gold);
        color: #fff;
    }

    .step.done .step-circle {
        border-color: var(--color-green);
        background: var(--color-green);
        color: #fff;
    }

    .step-label {
        font-size: 0.55rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: var(--color-muted);
    }

    .step.active .step-label { color: var(--color-gold); }
    .step.done  .step-label  { color: var(--color-green); }

    .step-line {
        width: 80px;
        height: 1px;
        background: var(--color-line);
        margin-bottom: 1.5rem;
    }

    .step-line.done { background: var(--color-green); }

    /* ── FORM CARD ───────────────────────────────── */
    .reserva-card {
        background: var(--color-bg);
        border: 1px solid var(--color-line);
        border-radius: 12px;
        padding: 2.5rem;
        box-shadow: 0 8px 40px rgba(0,0,0,0.05);
        margin-bottom: 2rem;
    }

    .reserva-card-title {
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--color-gold);
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--color-line);
    }

    .form-label-trp {
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

    .form-control-trp {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid var(--color-line);
        background: var(--color-bg-soft);
        font-family: var(--font-main);
        font-size: 0.85rem;
        color: var(--color-dark);
        outline: none;
        transition: all 0.2s ease;
        appearance: none;
        border-radius: 6px;
    }

    .form-control-trp:focus {
        border-color: var(--color-gold);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(200,162,77,0.1);
    }

    /* ── MAPA DE MESAS ───────────────────────────── */
    .mesas-section {
        margin-top: 2rem;
    }

    .mesas-leyenda {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
    }

    .leyenda-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--color-muted);
        letter-spacing: 1px;
    }

    .leyenda-dot {
        width: 14px;
        height: 14px;
        border-radius: 3px;
    }

    .leyenda-disponible { background: #E8F5E9; border: 1.5px solid var(--color-green); }
    .leyenda-ocupada    { background: #FDECEA; border: 1.5px solid #E53935; }
    .leyenda-seleccionada { background: var(--color-gold); border: 1.5px solid var(--color-gold-hover); }

    /* ── AREAS DEL RESTAURANTE ───────────────────── */
    .area-restaurante {
        background: var(--color-bg-soft);
        border: 1px solid var(--color-line);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .area-titulo {
        font-size: 0.6rem;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--color-muted);
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .mesas-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    /* ── MESA CARD ───────────────────────────────── */
    .mesa-btn {
        position: relative;
        width: 80px;
        height: 80px;
        border-radius: 10px;
        border: 2px solid var(--color-line);
        background: var(--color-bg);
        cursor: pointer;
        transition: all 0.25s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 4px;
        padding: 0;
    }

    .mesa-btn:disabled {
        cursor: not-allowed;
        opacity: 0.55;
    }

    .mesa-btn.disponible {
        border-color: var(--color-green);
        background: #F1FAF3;
    }

    .mesa-btn.disponible:hover {
        background: var(--color-green);
        border-color: var(--color-green);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(48,93,66,0.2);
    }

    .mesa-btn.disponible:hover .mesa-numero,
    .mesa-btn.disponible:hover .mesa-cap {
        color: #fff;
    }

    .mesa-btn.disponible:hover .mesa-icon {
        color: #fff;
    }

    .mesa-btn.ocupada {
        border-color: #FFCDD2;
        background: #FFF5F5;
        cursor: not-allowed;
    }

    .mesa-btn.seleccionada {
        border-color: var(--color-gold);
        background: var(--color-gold);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(200,162,77,0.35);
    }

    .mesa-btn.seleccionada .mesa-numero,
    .mesa-btn.seleccionada .mesa-cap,
    .mesa-btn.seleccionada .mesa-icon {
        color: #fff;
    }

    .mesa-icon {
        font-size: 1.3rem;
        color: var(--color-green);
        transition: color 0.2s;
    }

    .mesa-btn.ocupada .mesa-icon { color: #EF9A9A; }

    .mesa-numero {
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 1px;
        color: var(--color-dark);
        transition: color 0.2s;
    }

    .mesa-cap {
        font-size: 0.55rem;
        color: var(--color-muted);
        transition: color 0.2s;
        display: flex;
        align-items: center;
        gap: 2px;
    }

    .mesa-ocupada-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }

    /* ── RESUMEN SELECCIÓN ───────────────────────── */
    .resumen-box {
        background: linear-gradient(135deg, #1a1a1a, #2d2010);
        border-radius: 12px;
        padding: 2rem;
        color: #fff;
        position: sticky;
        top: 90px;
    }

    .resumen-title {
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--color-gold);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 8px;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .resumen-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
        gap: 1rem;
    }

    .resumen-key {
        font-size: 0.6rem;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: rgba(255,255,255,0.4);
        flex-shrink: 0;
    }

    .resumen-val {
        font-size: 0.8rem;
        font-weight: 600;
        color: #fff;
        text-align: right;
    }

    .resumen-val.gold { color: var(--color-gold); }

    /* ── LOADING ─────────────────────────────────── */
    .mesas-loading {
        text-align: center;
        padding: 3rem;
        color: var(--color-muted);
    }

    .spinner-gold {
        width: 32px;
        height: 32px;
        border: 3px solid var(--color-line);
        border-top-color: var(--color-gold);
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        margin: 0 auto 1rem;
    }

    @keyframes spin { to { transform: rotate(360deg); } }

    /* ── ALERTAS ─────────────────────────────────── */
    .alert-trp {
        padding: 1rem 1.25rem;
        border-radius: 8px;
        font-size: 0.82rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 1.5rem;
    }

    .alert-success { background: #E8F5E9; color: #2E7D32; border-left: 4px solid var(--color-green); }
    .alert-error   { background: #FDECEA; color: #C62828; border-left: 4px solid #E53935; }

    @media (max-width: 768px) {
        .steps-bar { gap: 0; }
        .step-line { width: 40px; }
        .mesa-btn { width: 68px; height: 68px; }
        .resumen-box { position: static; margin-top: 2rem; }
    }
    </style>
@endpush

@section('content')

<section class="reserva-hero">
    <div class="container">
        <p class="section-label">Reservaciones</p>
        <h1 class="section-title">RESERVAR MESA</h1>
        <div class="gold-divider mx-auto"></div>
        <p class="section-subtitle mx-auto">
            Elige tu sede, fecha, hora y mesa favorita.
        </p>
    </div>
</section>

<section style="padding: 60px 0 100px; background: var(--color-bg-soft);">
<div class="container">

    @if(session('success'))
        <div class="alert-trp alert-success">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert-trp alert-error">
            <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
        </div>
    @endif

    @guest
        {{-- Usuario no autenticado --}}
        <div style="max-width:500px;margin:0 auto;text-align:center;padding:4rem 2rem;">
            <i class="bi bi-lock" style="font-size:3.5rem;color:var(--color-line);display:block;margin-bottom:1.5rem;"></i>
            <h2 style="font-size:1.2rem;font-weight:800;text-transform:uppercase;letter-spacing:2px;margin-bottom:1rem;">
                Inicia Sesión para Reservar
            </h2>
            <p style="color:var(--color-muted);font-size:0.9rem;line-height:1.8;margin-bottom:2rem;">
                Necesitas una cuenta para realizar reservaciones y gestionar tu historial.
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('login') }}" class="btn-gold d-inline-flex align-items-center gap-2">
                    <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                </a>
                <a href="{{ route('register') }}" class="btn-outline-gold d-inline-flex align-items-center gap-2">
                    <i class="bi bi-person-plus"></i> Registrarse
                </a>
            </div>
        </div>
    @else

    <div class="row g-4">
        {{-- COLUMNA IZQUIERDA: Formulario --}}
        <div class="col-lg-8">

            {{-- Steps --}}
            <div class="steps-bar mb-4">
                <div class="step active" id="step1Indicator">
                    <div class="step-circle"><i class="bi bi-geo-alt"></i></div>
                    <span class="step-label">Detalles</span>
                </div>
                <div class="step-line" id="line1"></div>
                <div class="step" id="step2Indicator">
                    <div class="step-circle"><i class="bi bi-table"></i></div>
                    <span class="step-label">Mesa</span>
                </div>
                <div class="step-line" id="line2"></div>
                <div class="step" id="step3Indicator">
                    <div class="step-circle"><i class="bi bi-check-lg"></i></div>
                    <span class="step-label">Confirmar</span>
                </div>
            </div>

            <form action="{{ route('reservaciones.store') }}" method="POST" id="reservaForm">
                @csrf

                {{-- PASO 1: Detalles --}}
                <div class="reserva-card" id="step1">
                    <p class="reserva-card-title">
                        <i class="bi bi-calendar3"></i> Paso 1 — Detalles de la Reservación
                    </p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-trp"><i class="bi bi-geo-alt"></i>Sede</label>
                            <select name="sede_id" id="sedeSelect" class="form-control-trp" required>
                                <option value="">Selecciona una sede</option>
                                @foreach($sedes as $sede)
                                    <option value="{{ $sede->id }}"
                                        data-slug="{{ $sede->slug }}"
                                        {{ isset($sedeSeleccionada) && $sedeSeleccionada->id == $sede->id ? 'selected' : '' }}>
                                        {{ $sede->nombre }} — Zona {{ $sede->zona }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-trp"><i class="bi bi-people"></i>Número de Personas</label>
                            <select name="num_personas" id="personasSelect" class="form-control-trp" required>
                                <option value="">¿Cuántas personas?</option>
                                @for($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}">{{ $i }} persona{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-trp"><i class="bi bi-calendar3"></i>Fecha</label>
                            <input type="date" name="fecha" id="fechaInput"
                                   class="form-control-trp"
                                   min="{{ date('Y-m-d') }}"
                                   max="{{ date('Y-m-d', strtotime('+90 days')) }}"
                                   required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-trp"><i class="bi bi-clock"></i>Hora</label>
                            <select name="hora" id="horaSelect" class="form-control-trp" required>
                                <option value="">Selecciona la hora</option>
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
                            <label class="form-label-trp"><i class="bi bi-chat-left-text"></i>Notas especiales (opcional)</label>
                            <textarea name="notas" class="form-control-trp" rows="3"
                                      placeholder="Alergias, celebraciones especiales, preferencias de ubicación..."></textarea>
                        </div>
                        <div class="col-12">
                            <button type="button" id="buscarMesasBtn"
                                    class="btn-gold d-inline-flex align-items-center gap-2"
                                    style="border:none;">
                                <i class="bi bi-search"></i> Ver Mesas Disponibles
                            </button>
                        </div>
                    </div>
                </div>

                {{-- PASO 2: Mapa de mesas --}}
                <div class="reserva-card" id="step2" style="display:none;">
                    <p class="reserva-card-title">
                        <i class="bi bi-table"></i> Paso 2 — Selecciona tu Mesa
                    </p>

                    <div class="mesas-leyenda">
                        <div class="leyenda-item">
                            <div class="leyenda-dot leyenda-disponible"></div>
                            Disponible
                        </div>
                        <div class="leyenda-item">
                            <div class="leyenda-dot leyenda-ocupada"></div>
                            Ocupada
                        </div>
                        <div class="leyenda-item">
                            <div class="leyenda-dot leyenda-seleccionada"></div>
                            Tu selección
                        </div>
                    </div>

                    <div id="mesasContainer">
                        <div class="mesas-loading">
                            <div class="spinner-gold"></div>
                            <p style="font-size:0.8rem;letter-spacing:1px;">Buscando mesas disponibles...</p>
                        </div>
                    </div>

                    <input type="hidden" name="mesa_id" id="mesaIdInput">

                    <div id="step2Btns" style="margin-top:1.5rem;display:flex;gap:1rem;flex-wrap:wrap;">
                        <button type="button" id="volverBtn"
                                style="display:inline-flex;align-items:center;gap:6px;
                                       padding:12px 24px;background:transparent;
                                       border:1px solid var(--color-line);border-radius:6px;
                                       font-family:var(--font-main);font-size:0.65rem;
                                       font-weight:700;letter-spacing:2px;text-transform:uppercase;
                                       cursor:pointer;color:var(--color-muted);transition:all 0.2s;">
                            <i class="bi bi-arrow-left"></i> Volver
                        </button>
                        <button type="button" id="confirmarBtn"
                                class="btn-gold d-inline-flex align-items-center gap-2"
                                style="border:none;opacity:0.4;cursor:not-allowed;" disabled>
                            <i class="bi bi-calendar-check"></i> Confirmar Reservación
                        </button>
                    </div>
                </div>

                {{-- PASO 3: Confirmación final --}}
                <div class="reserva-card" id="step3" style="display:none;">
                    <p class="reserva-card-title">
                        <i class="bi bi-check-circle"></i> Paso 3 — Confirmar Reservación
                    </p>
                    <div id="resumenFinal" style="margin-bottom:2rem;"></div>
                    <div class="d-flex gap-3 flex-wrap">
                        <button type="button" id="volverBtn2"
                                style="display:inline-flex;align-items:center;gap:6px;
                                       padding:12px 24px;background:transparent;
                                       border:1px solid var(--color-line);border-radius:6px;
                                       font-family:var(--font-main);font-size:0.65rem;
                                       font-weight:700;letter-spacing:2px;text-transform:uppercase;
                                       cursor:pointer;color:var(--color-muted);transition:all 0.2s;">
                            <i class="bi bi-arrow-left"></i> Cambiar Mesa
                        </button>
                        <button type="submit"
                                class="btn-gold d-inline-flex align-items-center gap-2"
                                style="border:none;">
                            <i class="bi bi-check-circle-fill"></i> Confirmar y Reservar
                        </button>
                    </div>
                </div>

            </form>
        </div>

        {{-- COLUMNA DERECHA: Resumen --}}
        <div class="col-lg-4">
            <div class="resumen-box">
                <p class="resumen-title">
                    <i class="bi bi-receipt"></i> Tu Reservación
                </p>
                <div class="resumen-row">
                    <span class="resumen-key">Sede</span>
                    <span class="resumen-val" id="rSede">—</span>
                </div>
                <div class="resumen-row">
                    <span class="resumen-key">Fecha</span>
                    <span class="resumen-val" id="rFecha">—</span>
                </div>
                <div class="resumen-row">
                    <span class="resumen-key">Hora</span>
                    <span class="resumen-val" id="rHora">—</span>
                </div>
                <div class="resumen-row">
                    <span class="resumen-key">Personas</span>
                    <span class="resumen-val" id="rPersonas">—</span>
                </div>
                <div class="resumen-row">
                    <span class="resumen-key">Mesa</span>
                    <span class="resumen-val gold" id="rMesa">—</span>
                </div>
                <div style="margin-top:2rem;padding-top:1.5rem;border-top:1px solid rgba(255,255,255,0.1);">
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:1rem;">
                        <i class="bi bi-clock" style="color:var(--color-gold);"></i>
                        <div>
                            <p style="font-size:0.55rem;color:rgba(255,255,255,0.35);letter-spacing:1.5px;text-transform:uppercase;margin:0;">Horario</p>
                            <p style="font-size:0.75rem;color:#fff;margin:0;font-weight:600;">Lun–Dom · 11am–10pm</p>
                        </div>
                    </div>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <i class="bi bi-telephone" style="color:var(--color-gold);"></i>
                        <div>
                            <p style="font-size:0.55rem;color:rgba(255,255,255,0.35);letter-spacing:1.5px;text-transform:uppercase;margin:0;">Contacto</p>
                            <p style="font-size:0.75rem;color:#fff;margin:0;font-weight:600;">+503 2200-0000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endauth
</div>
</section>
@endsection

@push('scripts')
    <script>
    const horasLabels = {
        '11:00':'11:00 AM','11:30':'11:30 AM','12:00':'12:00 PM','12:30':'12:30 PM',
        '13:00':'1:00 PM','13:30':'1:30 PM','14:00':'2:00 PM','14:30':'2:30 PM',
        '18:00':'6:00 PM','18:30':'6:30 PM','19:00':'7:00 PM','19:30':'7:30 PM',
        '20:00':'8:00 PM','20:30':'8:30 PM','21:00':'9:00 PM','21:30':'9:30 PM'
    };

    const ubicacionIcons = {
        'interior': 'bi-house-door',
        'exterior': 'bi-tree',
        'terraza':  'bi-sun',
        'privada':  'bi-shield-lock'
    };

    let mesaSeleccionada = null;

    // Actualizar resumen lateral en tiempo real
    function actualizarResumen() {
        const sede     = document.getElementById('sedeSelect');
        const fecha    = document.getElementById('fechaInput').value;
        const hora     = document.getElementById('horaSelect').value;
        const personas = document.getElementById('personasSelect').value;

        document.getElementById('rSede').textContent =
            sede.value ? sede.options[sede.selectedIndex].text.split('—')[0].trim() : '—';

        if (fecha) {
            const d = new Date(fecha + 'T00:00:00');
            document.getElementById('rFecha').textContent =
                d.toLocaleDateString('es-SV', {weekday:'short', day:'numeric', month:'short', year:'numeric'});
        } else {
            document.getElementById('rFecha').textContent = '—';
        }

        document.getElementById('rHora').textContent  = hora ? (horasLabels[hora] || hora) : '—';
        document.getElementById('rPersonas').textContent = personas ? `${personas} persona${personas > 1 ? 's' : ''}` : '—';
    }

    ['sedeSelect','fechaInput','horaSelect','personasSelect'].forEach(id => {
        document.getElementById(id)?.addEventListener('change', actualizarResumen);
    });

    // Buscar mesas disponibles
    document.getElementById('buscarMesasBtn')?.addEventListener('click', async () => {
        const sede_id     = document.getElementById('sedeSelect').value;
        const fecha       = document.getElementById('fechaInput').value;
        const hora        = document.getElementById('horaSelect').value;
        const num_personas= document.getElementById('personasSelect').value;

        if (!sede_id || !fecha || !hora || !num_personas) {
            alert('Por favor completa todos los campos antes de buscar mesas.');
            return;
        }

        // Mostrar step 2
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'block';
        document.getElementById('step1Indicator').classList.remove('active');
        document.getElementById('step1Indicator').classList.add('done');
        document.getElementById('line1').classList.add('done');
        document.getElementById('step2Indicator').classList.add('active');

        // Mostrar spinner
        document.getElementById('mesasContainer').innerHTML = `
            <div class="mesas-loading">
                <div class="spinner-gold"></div>
                <p style="font-size:0.8rem;letter-spacing:1px;color:var(--color-muted);">
                    Consultando disponibilidad...
                </p>
            </div>`;

        try {
            const response = await fetch(
                `{{ route('reservaciones.mesas') }}?sede_id=${sede_id}&fecha=${fecha}&hora=${hora}&num_personas=${num_personas}`
            );
            const mesas = await response.json();
            renderizarMesas(mesas);
        } catch (e) {
            document.getElementById('mesasContainer').innerHTML = `
                <div class="alert-trp alert-error">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    Error al cargar las mesas. Intenta de nuevo.
                </div>`;
        }
    });

    function renderizarMesas(mesas) {
        if (!mesas.length) {
            document.getElementById('mesasContainer').innerHTML = `
                <div style="text-align:center;padding:3rem;">
                    <i class="bi bi-inbox" style="font-size:3rem;color:var(--color-line);display:block;margin-bottom:1rem;"></i>
                    <p style="color:var(--color-muted);font-size:0.9rem;">
                        No hay mesas disponibles para los parámetros seleccionados.
                    </p>
                </div>`;
            return;
        }

        // Agrupar por ubicación
        const grupos = {};
        mesas.forEach(m => {
            const u = m.ubicacion;
            if (!grupos[u]) grupos[u] = [];
            grupos[u].push(m);
        });

        const ubicacionLabels = {
            interior: 'Salón Interior',
            exterior: 'Área Exterior',
            terraza:  'Terraza',
            privada:  'Sala Privada'
        };

        let html = '';
        Object.entries(grupos).forEach(([ubicacion, listaMesas]) => {
            html += `
            <div class="area-restaurante">
                <div class="area-titulo">
                    <i class="bi ${ubicacionIcons[ubicacion] || 'bi-grid'}"></i>
                    ${ubicacionLabels[ubicacion] || ubicacion}
                    <span style="margin-left:auto;font-size:0.55rem;color:rgba(0,0,0,0.3);">
                        ${listaMesas.filter(m => m.disponible).length} disponibles
                    </span>
                </div>
                <div class="mesas-grid">
                    ${listaMesas.map(mesa => `
                        <button type="button"
                            class="mesa-btn ${mesa.disponible ? 'disponible' : 'ocupada'}"
                            data-id="${mesa.id}"
                            data-numero="${mesa.numero}"
                            data-cap="${mesa.capacidad}"
                            data-ubicacion="${mesa.ubicacion}"
                            ${!mesa.disponible ? 'disabled' : ''}
                            onclick="seleccionarMesa(this)">
                            <i class="bi ${mesa.disponible ? 'bi-check-circle' : 'bi-x-circle'} mesa-icon"></i>
                            <span class="mesa-numero">${mesa.numero}</span>
                            <span class="mesa-cap">
                                <i class="bi bi-people" style="font-size:0.5rem;"></i>${mesa.capacidad}
                            </span>
                        </button>
                    `).join('')}
                </div>
            </div>`;
        });

        document.getElementById('mesasContainer').innerHTML = html;
    }

    function seleccionarMesa(btn) {
        // Limpiar selección anterior
        document.querySelectorAll('.mesa-btn.seleccionada').forEach(b => {
            b.classList.remove('seleccionada');
            b.classList.add('disponible');
            b.querySelector('.mesa-icon').className = 'bi bi-check-circle mesa-icon';
        });

        // Marcar nueva selección
        btn.classList.remove('disponible');
        btn.classList.add('seleccionada');
        btn.querySelector('.mesa-icon').className = 'bi bi-check2-circle mesa-icon';

        mesaSeleccionada = {
            id: btn.dataset.id,
            numero: btn.dataset.numero,
            capacidad: btn.dataset.cap,
            ubicacion: btn.dataset.ubicacion
        };

        document.getElementById('mesaIdInput').value = mesaSeleccionada.id;
        document.getElementById('rMesa').textContent =
            `${mesaSeleccionada.numero} · ${mesaSeleccionada.capacidad} personas`;

        // Habilitar botón confirmar
        const confirmarBtn = document.getElementById('confirmarBtn');
        confirmarBtn.disabled = false;
        confirmarBtn.style.opacity = '1';
        confirmarBtn.style.cursor = 'pointer';
    }

    // Ir al paso 3
    document.getElementById('confirmarBtn')?.addEventListener('click', () => {
        if (!mesaSeleccionada) return;

        const sede     = document.getElementById('sedeSelect');
        const fecha    = document.getElementById('fechaInput').value;
        const hora     = document.getElementById('horaSelect').value;
        const personas = document.getElementById('personasSelect').value;
        const notas    = document.querySelector('textarea[name="notas"]').value;

        const d = new Date(fecha + 'T00:00:00');
        const fechaFormato = d.toLocaleDateString('es-SV', {
            weekday:'long', day:'numeric', month:'long', year:'numeric'
        });

        const ubicLabels = {interior:'Salón Interior',exterior:'Área Exterior',terraza:'Terraza',privada:'Sala Privada'};

        document.getElementById('resumenFinal').innerHTML = `
            <div style="display:grid;gap:1rem;">
                ${[
                    ['Sede',       sede.options[sede.selectedIndex].text.split('—')[0].trim(), 'bi-geo-alt-fill'],
                    ['Fecha',      fechaFormato,                                                'bi-calendar3'],
                    ['Hora',       horasLabels[hora] || hora,                                  'bi-clock'],
                    ['Personas',   `${personas} persona${personas > 1 ? 's' : ''}`,            'bi-people-fill'],
                    ['Mesa',       `${mesaSeleccionada.numero} · ${mesaSeleccionada.capacidad} personas`, 'bi-table'],
                    ['Ubicación',  ubicLabels[mesaSeleccionada.ubicacion] || mesaSeleccionada.ubicacion, 'bi-house-door'],
                    ...(notas ? [['Notas', notas, 'bi-chat-left-text']] : [])
                ].map(([k,v,icon]) => `
                    <div style="display:flex;align-items:flex-start;gap:1rem;padding:0.75rem;
                                background:var(--color-bg-soft);border-radius:8px;border:1px solid var(--color-line);">
                        <i class="bi ${icon}" style="color:var(--color-gold);margin-top:2px;flex-shrink:0;"></i>
                        <div>
                            <p style="font-size:0.55rem;font-weight:700;letter-spacing:2px;
                                      text-transform:uppercase;color:var(--color-muted);margin:0;">${k}</p>
                            <p style="font-size:0.88rem;font-weight:600;color:var(--color-dark);margin:0;">${v}</p>
                        </div>
                    </div>
                `).join('')}
            </div>`;

        document.getElementById('step2').style.display = 'none';
        document.getElementById('step3').style.display = 'block';
        document.getElementById('step2Indicator').classList.remove('active');
        document.getElementById('step2Indicator').classList.add('done');
        document.getElementById('line2').classList.add('done');
        document.getElementById('step3Indicator').classList.add('active');

        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Volver botones
    document.getElementById('volverBtn')?.addEventListener('click', () => {
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step1').style.display = 'block';
        document.getElementById('step1Indicator').classList.remove('done');
        document.getElementById('step1Indicator').classList.add('active');
        document.getElementById('step2Indicator').classList.remove('active');
        document.getElementById('line1').classList.remove('done');
        mesaSeleccionada = null;
        document.getElementById('rMesa').textContent = '—';
    });

    document.getElementById('volverBtn2')?.addEventListener('click', () => {
        document.getElementById('step3').style.display = 'none';
        document.getElementById('step2').style.display = 'block';
        document.getElementById('step2Indicator').classList.remove('done');
        document.getElementById('step2Indicator').classList.add('active');
        document.getElementById('step3Indicator').classList.remove('active');
        document.getElementById('line2').classList.remove('done');
    });
    </script>
@endpush