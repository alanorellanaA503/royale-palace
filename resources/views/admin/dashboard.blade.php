@extends('layouts.admin')

@section('title', 'Dashboard')
@section('topbar-icon', 'speedometer2')
@section('topbar-title', 'Dashboard')

@section('content')

    <div style="margin-bottom:2rem;">
        <p
            style="font-size:0.65rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--color-gold);margin-bottom:0.25rem;">
            Panel de Control
        </p>
        <h1 style="font-size:1.6rem;font-weight:800;color:var(--color-dark);letter-spacing:1px;">
            Bienvenido, {{ Auth::user()->name }}
        </h1>
    </div>

    {{-- Widgets --}}
    <div class="widget-grid">
        <div class="widget-card">
            <div class="widget-icon"><i class="bi bi-calendar-check"></i></div>
            <div class="widget-value">{{ $reservacionesHoy }}</div>
            <div class="widget-label">Reservaciones Hoy</div>
        </div>
        <div class="widget-card">
            <div class="widget-icon" style="background:rgba(48,93,66,0.1);">
                <i class="bi bi-calendar-month" style="color:var(--color-green);"></i>
            </div>
            <div class="widget-value">{{ $reservacionesMes }}</div>
            <div class="widget-label">Este Mes</div>
        </div>
        <div class="widget-card">
            <div class="widget-icon" style="background:rgba(33,150,243,0.1);">
                <i class="bi bi-table" style="color:#1976D2;"></i>
            </div>
            <div class="widget-value">{{ $mesasOcupadas }}</div>
            <div class="widget-label">Mesas Activas</div>
        </div>
        <div class="widget-card">
            <div class="widget-icon" style="background:rgba(156,39,176,0.1);">
                <i class="bi bi-egg-fried" style="color:#7B1FA2;"></i>
            </div>
            <div class="widget-value">{{ $platosDisponibles }}</div>
            <div class="widget-label">Platos Disponibles</div>
        </div>
        <div class="widget-card">
            <div class="widget-icon" style="background:rgba(255,152,0,0.1);">
                <i class="bi bi-people" style="color:#E65100;"></i>
            </div>
            <div class="widget-value">{{ $clientesRegistrados }}</div>
            <div class="widget-label">Clientes</div>
        </div>
    </div>

    {{-- Últimas reservaciones --}}
    <div class="content-card">
        <div class="content-card-header">
            <h2 class="content-card-title">
                <i class="bi bi-clock-history"></i> Últimas Reservaciones
            </h2>
            <a href="{{ route('admin.reservaciones.index') }}" class="btn-admin btn-admin-outline btn-admin-sm">
                Ver Todas <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div style="overflow-x:auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Cliente</th>
                        <th>Sede</th>
                        <th>Fecha · Hora</th>
                        <th>Mesa</th>
                        <th>Personas</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ultimasReservaciones as $res)
                                    <tr>
                                        <td>
                                            <span style="font-family:monospace;font-size:0.75rem;font-weight:700;color:var(--color-gold);">
                                                {{ $res->codigo }}
                                            </span>
                                        </td>
                                        <td>
                                            <div style="font-weight:600;">{{ $res->user->name }}</div>
                                            <div style="font-size:0.7rem;color:var(--color-muted);">{{ $res->user->email }}</div>
                                        </td>
                                        <td>{{ $res->sede->nombre }}</td>
                                        <td>
                                            <div style="font-weight:600;">{{ $res->fecha->format('d/m/Y') }}</div>
                                            <div style="font-size:0.75rem;color:var(--color-muted);">{{ $res->hora }}</div>
                                        </td>
                                        <td>{{ $res->mesa->numero }}</td>
                                        <td>{{ $res->num_personas }}</td>
                                        <td>
                                            <span class="badge {{ match ($res->estado) {
                            'confirmada' => 'badge-green',
                            'pendiente' => 'badge-gold',
                            'cancelada' => 'badge-red',
                            default => 'badge-gray'
                        } }}">
                                                {{ ucfirst($res->estado) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($res->estado === 'pendiente')
                                                <form method="POST" action="{{ route('admin.reservaciones.estado', $res) }}"
                                                    style="display:inline">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="estado" value="confirmada">
                                                    <button class="btn-admin btn-admin-sm"
                                                        style="background:rgba(48,93,66,0.1);color:#305D42;border:1px solid rgba(48,93,66,0.2);border-radius:6px;">
                                                        <i class="bi bi-check-circle"></i> Confirmar
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align:center;padding:3rem;color:var(--color-muted);">
                                <i class="bi bi-inbox"
                                    style="font-size:2rem;display:block;margin-bottom:0.5rem;opacity:0.3;"></i>
                                No hay reservaciones registradas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection