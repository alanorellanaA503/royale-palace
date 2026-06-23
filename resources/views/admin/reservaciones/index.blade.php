@extends('layouts.admin')
@section('title', 'Reservaciones')
@section('topbar-icon', 'calendar-check')
@section('topbar-title', 'Gestión de Reservaciones')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <p
                style="font-size:0.65rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--color-gold);margin-bottom:0.25rem;">
                Gestión</p>
            <h1 style="font-size:1.4rem;font-weight:800;color:var(--color-dark);">Reservaciones</h1>
        </div>
        <a href="{{ route('admin.reservaciones.reporte') }}" class="btn-admin btn-admin-gold" target="_blank">
            <i class="bi bi-file-earmark-pdf"></i> Generar Reporte PDF
        </a>
    </div>

    {{-- Filtros --}}
    <div class="content-card" style="margin-bottom:1.5rem;">
        <div class="content-card-body">
            <form method="GET" action="{{ route('admin.reservaciones.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label-admin"><i class="bi bi-calendar3"></i> Fecha</label>
                        <input type="date" name="fecha" class="form-control-admin" value="{{ request('fecha') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-admin"><i class="bi bi-circle-fill"></i> Estado</label>
                        <select name="estado" class="form-control-admin">
                            <option value="">Todos</option>
                            <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente
                            </option>
                            <option value="confirmada" {{ request('estado') == 'confirmada' ? 'selected' : '' }}>Confirmada
                            </option>
                            <option value="cancelada" {{ request('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada
                            </option>
                            <option value="completada" {{ request('estado') == 'completada' ? 'selected' : '' }}>Completada
                            </option>
                        </select>
                    </div>
                    @hasrole('super_admin')
                    <div class="col-md-3">
                        <label class="form-label-admin"><i class="bi bi-geo-alt"></i> Sede</label>
                        <select name="sede_id" class="form-control-admin">
                            <option value="">Todas las sedes</option>
                            @foreach(\App\Models\Sede::all() as $s)
                                <option value="{{ $s->id }}" {{ request('sede_id') == $s->id ? 'selected' : '' }}>
                                    {{ $s->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endhasrole
                    <div class="col-md-2">
                        <button type="submit" class="btn-admin btn-admin-gold" style="width:100%;">
                            <i class="bi bi-search"></i> Filtrar
                        </button>
                    </div>
                    <div class="col-md-1">
                        <a href="{{ route('admin.reservaciones.index') }}" class="btn-admin btn-admin-outline"
                            style="width:100%;">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabla --}}
    <div class="content-card">
        <div class="content-card-header">
            <h2 class="content-card-title">
                <i class="bi bi-list-ul"></i> Lista de Reservaciones
                <span style="font-size:0.65rem;font-weight:600;color:var(--color-muted);margin-left:0.5rem;">
                    ({{ $reservaciones->total() }} total)
                </span>
            </h2>
        </div>

        <div style="overflow-x:auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Cliente</th>
                        <th>Sede</th>
                        <th>Fecha · Hora</th>
                        <th>Mesa · Personas</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservaciones as $res)
                                    <tr>
                                        <td>
                                            <span style="font-family:monospace;font-size:0.72rem;font-weight:700;color:var(--color-gold);">
                                                {{ $res->codigo }}
                                            </span>
                                        </td>
                                        <td>
                                            <div style="font-weight:600;font-size:0.82rem;">{{ $res->user->name }}</div>
                                            <div style="font-size:0.7rem;color:var(--color-muted);">{{ $res->user->email }}</div>
                                        </td>
                                        <td style="font-size:0.82rem;">{{ $res->sede->nombre }}</td>
                                        <td>
                                            <div style="font-weight:600;font-size:0.82rem;">{{ $res->fecha->format('d/m/Y') }}</div>
                                            <div style="font-size:0.75rem;color:var(--color-muted);">{{ $res->hora }}</div>
                                        </td>
                                        <td>
                                            <div style="font-weight:600;font-size:0.82rem;">{{ $res->mesa->numero }}</div>
                                            <div style="font-size:0.75rem;color:var(--color-muted);">{{ $res->num_personas }} personas</div>
                                        </td>
                                        <td>
                                            <span class="badge {{ match ($res->estado) {
                            'confirmada' => 'badge-green',
                            'pendiente' => 'badge-gold',
                            'cancelada' => 'badge-red',
                            default => 'badge-gray'
                        } }}">{{ ucfirst($res->estado) }}</span>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:6px;flex-wrap:wrap;">
                                                @if($res->estado === 'pendiente')
                                                    <form method="POST" action="{{ route('admin.reservaciones.estado', $res) }}">
                                                        @csrf @method('PATCH')
                                                        <input type="hidden" name="estado" value="confirmada">
                                                        <button class="btn-admin btn-admin-sm"
                                                            style="background:rgba(48,93,66,0.1);color:#305D42;border:1px solid rgba(48,93,66,0.2);border-radius:6px;">
                                                            <i class="bi bi-check-circle"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                @if(in_array($res->estado, ['pendiente', 'confirmada']))
                                                    <form method="POST" action="{{ route('admin.reservaciones.estado', $res) }}"
                                                        onsubmit="return confirm('¿Cancelar esta reservación?')">
                                                        @csrf @method('PATCH')
                                                        <input type="hidden" name="estado" value="cancelada">
                                                        <button class="btn-admin btn-admin-danger btn-admin-sm">
                                                            <i class="bi bi-x-circle"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                @if($res->estado === 'confirmada')
                                                    <form method="POST" action="{{ route('admin.reservaciones.estado', $res) }}">
                                                        @csrf @method('PATCH')
                                                        <input type="hidden" name="estado" value="completada">
                                                        <button class="btn-admin btn-admin-sm"
                                                            style="background:rgba(33,150,243,0.1);color:#1565C0;border:1px solid rgba(33,150,243,0.2);border-radius:6px;">
                                                            <i class="bi bi-check2-all"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center;padding:3rem;color:var(--color-muted);">
                                <i class="bi bi-calendar-x"
                                    style="font-size:2.5rem;display:block;margin-bottom:0.75rem;opacity:0.3;"></i>
                                No hay reservaciones con los filtros seleccionados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($reservaciones->hasPages())
            <div style="padding:1.25rem 1.5rem;border-top:1px solid var(--color-line);">
                {{ $reservaciones->withQueryString()->links() }}
            </div>
        @endif
    </div>

@endsection