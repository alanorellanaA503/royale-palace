@extends('layouts.admin')
@section('title', 'Mesas')
@section('topbar-icon', 'table')
@section('topbar-title', 'Gestión de Mesas')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <p
                style="font-size:0.65rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--color-gold);margin-bottom:0.25rem;">
                Gestión</p>
            <h1 style="font-size:1.4rem;font-weight:800;color:var(--color-dark);">Mesas</h1>
        </div>
        <a href="{{ route('admin.mesas.create') }}" class="btn-admin btn-admin-gold">
            <i class="bi bi-plus-circle"></i> Nueva Mesa
        </a>
    </div>

    <div class="content-card">
        <div style="overflow-x:auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Número</th>
                        <th>Sede</th>
                        <th>Capacidad</th>
                        <th>Ubicación</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mesas as $mesa)
                                    <tr>
                                        <td style="font-weight:700;">{{ $mesa->numero }}</td>
                                        <td>{{ $mesa->sede->nombre }}</td>
                                        <td>{{ $mesa->capacidad }} personas</td>
                                        <td>
                                            <span class="badge badge-gray">
                                                <i class="bi bi-{{ match ($mesa->ubicacion) {
                            'interior' => 'house-door',
                            'exterior' => 'tree',
                            'terraza' => 'sun',
                            'privada' => 'shield-lock',
                            default => 'table'
                        } }}"></i>
                                                {{ ucfirst($mesa->ubicacion) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge {{ $mesa->activa ? 'badge-green' : 'badge-red' }}">
                                                {{ $mesa->activa ? 'Activa' : 'Inactiva' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:6px;">
                                                <a href="{{ route('admin.mesas.edit', $mesa) }}"
                                                    class="btn-admin btn-admin-outline btn-admin-sm">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form method="POST" action="{{ route('admin.mesas.destroy', $mesa) }}"
                                                    onsubmit="return confirm('¿Eliminar esta mesa?')">
                                                    @csrf @method('DELETE')
                                                    <button class="btn-admin btn-admin-danger btn-admin-sm">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;padding:3rem;color:var(--color-muted);">
                                <i class="bi bi-table"
                                    style="font-size:2rem;display:block;margin-bottom:0.5rem;opacity:0.3;"></i>
                                No hay mesas registradas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection