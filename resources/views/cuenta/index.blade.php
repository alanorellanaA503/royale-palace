@extends('layouts.app')
@section('title', 'Mi Cuenta — The Royale Palace')

@push('styles')
    <style>
        .cuenta-hero {
            padding: 80px 0 60px;
            background: linear-gradient(135deg, var(--color-bg-soft) 0%, var(--color-bg) 100%);
            position: relative;
            overflow: hidden;
        }

        .cuenta-hero::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(200, 162, 77, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .avatar-circle {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--color-gold), var(--color-green));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: 800;
            color: #fff;
            box-shadow: 0 6px 20px rgba(200, 162, 77, 0.3);
            flex-shrink: 0;
        }

        .stat-mini {
            background: var(--color-bg);
            border: 1px solid var(--color-line);
            border-radius: 12px;
            padding: 1.25rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-mini:hover {
            border-color: var(--color-gold);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transform: translateY(-2px);
        }

        .res-card {
            background: var(--color-bg);
            border: 1px solid var(--color-line);
            border-radius: 12px;
            padding: 1.5rem 1.75rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .res-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            border-radius: 2px 0 0 2px;
        }

        .res-card.confirmada::before {
            background: var(--color-green);
        }

        .res-card.pendiente::before {
            background: var(--color-gold);
        }

        .res-card.cancelada::before {
            background: #E53935;
        }

        .res-card.completada::before {
            background: #9E9E9E;
        }

        .res-card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.07);
            transform: translateY(-2px);
        }

        .estado-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.58rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .pill-confirmada {
            background: rgba(48, 93, 66, 0.1);
            color: #305D42;
        }

        .pill-pendiente {
            background: rgba(200, 162, 77, 0.1);
            color: #A8862C;
        }

        .pill-cancelada {
            background: rgba(229, 57, 53, 0.1);
            color: #C62828;
        }

        .pill-completada {
            background: rgba(0, 0, 0, 0.05);
            color: var(--color-muted);
        }

        .btn-accion {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 7px 14px;
            font-family: var(--font-main);
            font-size: 0.58rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }

        .btn-comprobante {
            background: rgba(200, 162, 77, 0.1);
            color: var(--color-gold);
            border: 1px solid rgba(200, 162, 77, 0.3);
        }

        .btn-comprobante:hover {
            background: var(--color-gold);
            color: #fff;
        }

        .btn-cancelar {
            background: rgba(229, 57, 53, 0.08);
            color: #E53935;
            border: 1px solid rgba(229, 57, 53, 0.2);
        }

        .btn-cancelar:hover {
            background: #E53935;
            color: #fff;
        }

        .tab-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            font-family: var(--font-main);
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            background: transparent;
            border: none;
            border-bottom: 2px solid transparent;
            color: var(--color-muted);
            cursor: pointer;
            transition: all 0.2s;
        }

        .tab-btn.active {
            color: var(--color-gold);
            border-bottom-color: var(--color-gold);
        }

        .tab-btn:hover {
            color: var(--color-gold);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

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

        .alert-success {
            background: #E8F5E9;
            color: #2E7D32;
            border-left: 4px solid var(--color-green);
        }

        .alert-error {
            background: #FDECEA;
            color: #C62828;
            border-left: 4px solid #E53935;
        }

        .empty-box {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--color-bg-soft);
            border: 1px dashed var(--color-line);
            border-radius: 12px;
        }
    </style>
@endpush

@section('content')

        {{-- Hero --}}
        <section class="cuenta-hero">
            <div class="container">
                <div class="d-flex align-items-center gap-4 flex-wrap">
                    <div class="avatar-circle">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="section-label" style="margin-bottom:0.4rem;">Bienvenido de vuelta</p>
                        <h1 style="font-size:clamp(1.4rem,3vw,2rem);font-weight:800;
                                           text-transform:uppercase;letter-spacing:2px;color:var(--color-dark);margin:0;">
                            {{ Auth::user()->name }}
                        </h1>
                        <p style="color:var(--color-muted);font-size:0.82rem;margin:0.3rem 0 0;">
                            <i class="bi bi-envelope me-1"></i>{{ Auth::user()->email }}
                        </p>
                    </div>
                    <div class="ms-auto d-none d-md-flex gap-3">
                        <a href="{{ route('reservaciones.create') }}" class="btn-gold d-inline-flex align-items-center gap-2"
                            style="font-size:0.62rem;padding:10px 20px;">
                            <i class="bi bi-calendar-plus"></i> Nueva Reservación
                        </a>
                        <a href="{{ route('favoritos.index') }}" class="btn-outline-gold d-inline-flex align-items-center gap-2"
                            style="font-size:0.62rem;padding:10px 20px;">
                            <i class="bi bi-heart"></i> Mis Favoritos
                        </a>
                    </div>

                    @if(Auth::user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" style="position:fixed;bottom:25px;right:25px;z-index:1000;
                                  background:var(--color-dark);
                                  display:inline-flex;align-items:center;gap:8px;
                                  padding:12px 20px;border-radius:30px;
                                  border:1.5px solid var(--color-gold);
                                  text-decoration:none;transition:all 0.3s ease;
                                  box-shadow:0 4px 20px rgba(0,0,0,0.25);"
                            onmouseover="this.style.background='var(--color-gold)';this.style.boxShadow='0 8px 30px rgba(200,162,77,0.4)';"
                            onmouseout="this.style.background='var(--color-dark)';this.style.boxShadow='0 4px 20px rgba(0,0,0,0.25)';"
                            title="Panel Administrador">
                            <i class="bi bi-speedometer2" style="color:var(--color-gold);font-size:1rem;transition:color 0.3s;"
                                onmouseover="this.style.color='#fff'" onmouseout="this.style.color='var(--color-gold)'"></i>
                            <span style="color:var(--color-gold);font-family:var(--font-main);font-size:0.62rem;
                                         font-weight:700;letter-spacing:2px;text-transform:uppercase;transition:color 0.3s;"
                                onmouseover="this.style.color='#fff'" onmouseout="this.style.color='var(--color-gold)'">
                                Dashboard
                            </span>
                        </a>
                    @endif
                    
                </div>
            </div>
        </section>

        <section style="padding: 50px 0 100px; background: var(--color-bg-soft);">
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

                {{-- Stats --}}
                <div class="row g-3 mb-4">
                    @php
    $total = $reservaciones->count();
    $proxCount = $proximas->count();
    $compCount = $reservaciones->where('estado', 'completada')->count();
    $cancelCount = $reservaciones->where('estado', 'cancelada')->count();
    $favCount = Auth::user()->favoritos()->count();
                    @endphp
                    <div class="col-6 col-md">
                        <div class="stat-mini">
                            <i class="bi bi-calendar3"
                                style="font-size:1.4rem;color:var(--color-gold);display:block;margin-bottom:0.5rem;"></i>
                            <div style="font-size:1.8rem;font-weight:800;color:var(--color-dark);line-height:1;">{{ $total }}
                            </div>
                            <div
                                style="font-size:0.58rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--color-muted);margin-top:0.3rem;">
                                Total</div>
                        </div>
                    </div>
                    <div class="col-6 col-md">
                        <div class="stat-mini">
                            <i class="bi bi-calendar-check"
                                style="font-size:1.4rem;color:var(--color-green);display:block;margin-bottom:0.5rem;"></i>
                            <div style="font-size:1.8rem;font-weight:800;color:var(--color-dark);line-height:1;">
                                {{ $proxCount }}
                            </div>
                            <div
                                style="font-size:0.58rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--color-muted);margin-top:0.3rem;">
                                Próximas</div>
                        </div>
                    </div>
                    <div class="col-6 col-md">
                        <div class="stat-mini">
                            <i class="bi bi-check2-circle"
                                style="font-size:1.4rem;color:#1976D2;display:block;margin-bottom:0.5rem;"></i>
                            <div style="font-size:1.8rem;font-weight:800;color:var(--color-dark);line-height:1;">
                                {{ $compCount }}
                            </div>
                            <div
                                style="font-size:0.58rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--color-muted);margin-top:0.3rem;">
                                Completadas</div>
                        </div>
                    </div>
                    <div class="col-6 col-md">
                        <div class="stat-mini">
                            <i class="bi bi-heart-fill"
                                style="font-size:1.4rem;color:#E53935;display:block;margin-bottom:0.5rem;"></i>
                            <div style="font-size:1.8rem;font-weight:800;color:var(--color-dark);line-height:1;">{{ $favCount }}
                            </div>
                            <div
                                style="font-size:0.58rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--color-muted);margin-top:0.3rem;">
                                Favoritos</div>
                        </div>
                    </div>
                </div>

                {{-- Tabs --}}
                <div style="border-bottom: 1px solid var(--color-line); margin-bottom: 2rem; display:flex; gap:0;">
                    <button class="tab-btn active" onclick="switchTab('proximas', this)">
                        <i class="bi bi-calendar-check"></i> Reservaciones Próximas
                        @if($proxCount > 0)
                            <span style="background:var(--color-gold);color:#fff;font-size:0.55rem;
                                                     padding:2px 7px;border-radius:10px;">{{ $proxCount }}</span>
                        @endif
                    </button>
                    <button class="tab-btn" onclick="switchTab('historial', this)">
                        <i class="bi bi-clock-history"></i> Historial
                    </button>
                    <button class="tab-btn" onclick="switchTab('favoritos', this)">
                        <i class="bi bi-heart"></i> Favoritos
                    </button>
                </div>

                {{-- Tab: Próximas --}}
                <div class="tab-content active" id="tab-proximas">
                    @forelse($proximas as $res)
                        <div class="res-card {{ $res->estado }}">
                            <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
                                <div style="flex:1;min-width:0;">
                                    <div class="d-flex align-items-center gap-2 mb-3 flex-wrap">
                                        <span class="estado-pill pill-{{ $res->estado }}">
                                            <i class="bi bi-circle-fill" style="font-size:0.4rem;"></i>
                                            {{ ucfirst($res->estado) }}
                                        </span>
                                        <span style="font-family:monospace;font-size:0.7rem;font-weight:700;
                                                                 color:var(--color-gold);letter-spacing:1px;">
                                            {{ $res->codigo }}
                                        </span>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-6 col-md-3">
                                            <p
                                                style="font-size:0.55rem;color:var(--color-muted);letter-spacing:1.5px;text-transform:uppercase;margin:0;">
                                                Sede</p>
                                            <p style="font-size:0.88rem;font-weight:700;color:var(--color-dark);margin:0;">
                                                {{ $res->sede->nombre }}
                                            </p>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <p
                                                style="font-size:0.55rem;color:var(--color-muted);letter-spacing:1.5px;text-transform:uppercase;margin:0;">
                                                Fecha</p>
                                            <p style="font-size:0.88rem;font-weight:700;color:var(--color-dark);margin:0;">
                                                {{ $res->fecha->format('d/m/Y') }}
                                            </p>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <p
                                                style="font-size:0.55rem;color:var(--color-muted);letter-spacing:1.5px;text-transform:uppercase;margin:0;">
                                                Hora · Mesa</p>
                                            <p style="font-size:0.88rem;font-weight:700;color:var(--color-dark);margin:0;">
                                                {{ $res->hora }} · {{ $res->mesa->numero }}
                                            </p>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <p
                                                style="font-size:0.55rem;color:var(--color-muted);letter-spacing:1.5px;text-transform:uppercase;margin:0;">
                                                Personas</p>
                                            <p style="font-size:0.88rem;font-weight:700;color:var(--color-dark);margin:0;">
                                                {{ $res->num_personas }}
                                            </p>
                                        </div>
                                    </div>
                                    @if($res->notas)
                                        <p style="font-size:0.75rem;color:var(--color-muted);margin-top:0.75rem;">
                                            <i class="bi bi-chat-left-text me-1" style="color:var(--color-gold);"></i>
                                            {{ $res->notas }}
                                        </p>
                                    @endif
                                </div>
                                <div style="display:flex;flex-direction:column;gap:0.5rem;align-items:flex-end;">
                                    {{-- Comprobante --}}
                                    <a href="{{ route('reservaciones.comprobante', $res) }}" target="_blank"
                                        class="btn-accion btn-comprobante">
                                        <i class="bi bi-printer"></i> Comprobante
                                    </a>
                                    {{-- Cancelar --}}
                                    @if(in_array($res->estado, ['pendiente', 'confirmada']) && $res->fecha >= today())
                                        <form method="POST" action="{{ route('reservaciones.cancelar', $res) }}"
                                            onsubmit="return confirm('¿Cancelar esta reservación?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-accion btn-cancelar">
                                                <i class="bi bi-x-circle"></i> Cancelar
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-box">
                            <i class="bi bi-calendar-x"
                                style="font-size:3rem;color:var(--color-line);display:block;margin-bottom:1rem;"></i>
                            <p style="color:var(--color-muted);font-size:0.9rem;margin-bottom:1.5rem;">
                                No tienes reservaciones próximas.
                            </p>
                            <a href="{{ route('reservaciones.create') }}" class="btn-gold d-inline-flex align-items-center gap-2">
                                <i class="bi bi-calendar-plus"></i> Hacer una Reservación
                            </a>
                        </div>
                    @endforelse
                </div>

                {{-- Tab: Historial --}}
                <div class="tab-content" id="tab-historial">
                    @forelse($historial as $res)
                        <div class="res-card {{ $res->estado }}" style="opacity:0.75;">
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <span class="estado-pill pill-{{ $res->estado }}">{{ ucfirst($res->estado) }}</span>
                                <span style="font-family:monospace;font-size:0.7rem;font-weight:700;color:var(--color-gold);">
                                    {{ $res->codigo }}
                                </span>
                                <span style="font-size:0.8rem;color:var(--color-muted);">
                                    <i class="bi bi-geo-alt me-1"></i>{{ $res->sede->nombre }}
                                </span>
                                <span style="font-size:0.8rem;color:var(--color-muted);">
                                    <i class="bi bi-calendar3 me-1"></i>{{ $res->fecha->format('d/m/Y') }} · {{ $res->hora }}
                                </span>
                                <span style="font-size:0.8rem;color:var(--color-muted);">
                                    <i class="bi bi-table me-1"></i>{{ $res->mesa->numero }}
                                </span>
                                <div style="margin-left:auto;">
                                    <a href="{{ route('reservaciones.comprobante', $res) }}" target="_blank"
                                        class="btn-accion btn-comprobante" style="font-size:0.55rem;padding:5px 10px;">
                                        <i class="bi bi-printer"></i> Ver
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-box">
                            <i class="bi bi-clock-history"
                                style="font-size:3rem;color:var(--color-line);display:block;margin-bottom:1rem;"></i>
                            <p style="color:var(--color-muted);font-size:0.9rem;">No hay reservaciones en el historial aún.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Tab: Favoritos --}}
                <div class="tab-content" id="tab-favoritos">
                    @php
    $favs = Auth::user()->favoritos()->with(['plato.sede', 'plato.categoria'])->get();
                    @endphp
                    @if($favs->isEmpty())
                        <div class="empty-box">
                            <i class="bi bi-heart"
                                style="font-size:3rem;color:var(--color-line);display:block;margin-bottom:1rem;"></i>
                            <p style="color:var(--color-muted);font-size:0.9rem;margin-bottom:1.5rem;">
                                Aún no tienes platillos favoritos.
                            </p>
                            <a href="{{ route('menu.index') }}" class="btn-gold d-inline-flex align-items-center gap-2">
                                <i class="bi bi-book-half"></i> Explorar el Menú
                            </a>
                        </div>
                    @else
                        <div class="row g-3">
                            @foreach($favs as $fav)
                                @php $plato = $fav->plato; @endphp
                                <div class="col-md-6 col-lg-4">
                                    <div style="background:var(--color-bg);border:1px solid var(--color-line);
                                                                    border-radius:10px;padding:1.25rem;transition:all 0.3s;height:100%;"
                                        onmouseover="this.style.borderColor='var(--color-gold)';this.style.boxShadow='0 8px 24px rgba(0,0,0,0.07)'"
                                        onmouseout="this.style.borderColor='var(--color-line)';this.style.boxShadow='none'">
                                        <p style="font-size:0.55rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;
                                                                      color:var(--color-gold);margin-bottom:0.4rem;">
                                            <i class="bi bi-geo-alt-fill me-1"></i>{{ $plato->sede->nombre }}
                                        </p>
                                        <h4
                                            style="font-size:0.85rem;font-weight:700;text-transform:uppercase;
                                                                       letter-spacing:1px;color:var(--color-dark);margin-bottom:0.5rem;">
                                            {{ $plato->nombre }}
                                        </h4>
                                        <p style="font-size:0.75rem;color:var(--color-muted);line-height:1.6;margin-bottom:1rem;">
                                            {{ Str::limit($plato->descripcion, 80) }}
                                        </p>
                                        <div style="display:flex;justify-content:space-between;align-items:center;
                                                                        padding-top:0.75rem;border-top:1px solid var(--color-line);">
                                            <span style="font-size:1rem;font-weight:700;color:var(--color-gold);">
                                                ${{ number_format($plato->precio, 2) }}
                                            </span>
                                            <form method="POST" action="{{ route('favoritos.toggle', $plato) }}">
                                                @csrf
                                                <button type="submit"
                                                    style="background:none;border:none;cursor:pointer;
                                                                                   font-size:1.1rem;color:#EF5350;transition:transform 0.2s;"
                                                    title="Quitar de favoritos" onmouseover="this.style.transform='scale(1.2)'"
                                                    onmouseout="this.style.transform='scale(1)'">
                                                    <i class="bi bi-heart-fill"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ route('favoritos.index') }}"
                                class="btn-outline-gold d-inline-flex align-items-center gap-2">
                                <i class="bi bi-heart-fill"></i> Ver Todos mis Favoritos
                            </a>
                        </div>
                    @endif
                </div>

            </div>
        </section>
@endsection

@push('scripts')
    <script>
        function switchTab(name, btn) {
            document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.getElementById('tab-' + name).classList.add('active');
            btn.classList.add('active');
        }
    </script>
@endpush