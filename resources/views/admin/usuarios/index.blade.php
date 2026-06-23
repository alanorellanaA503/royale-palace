@extends('layouts.admin')
@section('title', 'Usuarios')
@section('topbar-icon', 'people')
@section('topbar-title', 'Gestión de Usuarios')

@section('content')

    <div style="margin-bottom:2rem;">
        <p
            style="font-size:0.65rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--color-gold);margin-bottom:0.25rem;">
            Gestión</p>
        <h1 style="font-size:1.4rem;font-weight:800;color:var(--color-dark);">Usuarios Registrados</h1>
    </div>

    <div class="content-card">
        <div class="content-card-header">
            <h2 class="content-card-title">
                <i class="bi bi-people"></i> Clientes del Sistema
                <span style="font-size:0.65rem;font-weight:600;color:var(--color-muted);margin-left:0.5rem;">
                    ({{ $usuarios->total() }} total)
                </span>
            </h2>
            {{-- Buscador --}}
            <form method="GET" style="display:flex;gap:0.5rem;">
                <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar por nombre o correo..."
                    class="form-control-admin" style="width:260px;">
                <button type="submit" class="btn-admin btn-admin-gold">
                    <i class="bi bi-search"></i>
                </button>
                @if(request('buscar'))
                    <a href="{{ route('admin.usuarios.index') }}" class="btn-admin btn-admin-outline">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </form>
        </div>

        <div style="overflow-x:auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Reservaciones</th>
                        <th>Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $usuario)
                        <tr>
                            <td style="color:var(--color-muted);font-size:0.75rem;">{{ $usuario->id }}</td>
                            <td>
                                <div style="display:flex;align-items:center;gap:0.75rem;">
                                    <div style="width:36px;height:36px;border-radius:50%;
                                                        background:linear-gradient(135deg,var(--color-gold),var(--color-green));
                                                        display:flex;align-items:center;justify-content:center;
                                                        font-size:0.8rem;font-weight:800;color:#fff;flex-shrink:0;">
                                        {{ strtoupper(substr($usuario->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight:700;font-size:0.85rem;">{{ $usuario->name }}</div>
                                        <div style="font-size:0.65rem;color:var(--color-muted);">
                                            @foreach($usuario->roles as $rol)
                                                <span
                                                    style="background:rgba(200,162,77,0.1);color:var(--color-gold);
                                                                         padding:2px 8px;border-radius:10px;font-weight:700;
                                                                         letter-spacing:1px;font-size:0.6rem;text-transform:uppercase;">
                                                    {{ $rol->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="font-size:0.82rem;">{{ $usuario->email }}</td>
                            <td style="font-size:0.82rem;color:var(--color-muted);">
                                {{ $usuario->telefono ?? '—' }}
                            </td>
                            <td style="text-align:center;">
                                <span style="font-size:1rem;font-weight:700;color:var(--color-gold);">
                                    {{ $usuario->reservaciones_count }}
                                </span>
                            </td>
                            <td style="font-size:0.75rem;color:var(--color-muted);">
                                {{ $usuario->created_at->format('d/m/Y') }}
                            </td>
                            <td>
                                <form method="POST" action="{{ route('admin.usuarios.destroy', $usuario) }}"
                                    onsubmit="return confirm('¿Eliminar usuario {{ $usuario->name }}?')">
                                    @csrf @method('DELETE')
                                    <button class="btn-admin btn-admin-danger btn-admin-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center;padding:3rem;color:var(--color-muted);">
                                <i class="bi bi-people"
                                    style="font-size:2.5rem;display:block;margin-bottom:0.75rem;opacity:0.3;"></i>
                                No hay usuarios registrados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($usuarios->hasPages())
            <div style="padding:1.25rem 1.5rem;border-top:1px solid var(--color-line);">
                {{ $usuarios->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection