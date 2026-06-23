@extends('layouts.admin')
@section('title', 'Generar Reporte PDF')
@section('topbar-icon', 'file-earmark-pdf')
@section('topbar-title', 'Generar Reporte PDF')

@section('content')

    <div style="margin-bottom:2rem;">
        <p
            style="font-size:0.65rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--color-gold);margin-bottom:0.25rem;">
            Reportes</p>
        <h1 style="font-size:1.4rem;font-weight:800;color:var(--color-dark);">Generar Reporte PDF</h1>
    </div>

    <div class="row g-4">

        {{-- Reporte por Mes --}}
        <div class="col-md-6">
            <div class="content-card">
                <div class="content-card-header">
                    <h2 class="content-card-title">
                        <i class="bi bi-calendar-month"></i> Reporte Mensual
                    </h2>
                </div>
                <div class="content-card-body">
                    <form method="GET" action="{{ route('admin.reservaciones.reporte') }}" target="_blank">
                        <div class="form-group-admin">
                            <label class="form-label-admin"><i class="bi bi-calendar3"></i> Mes</label>
                            <select name="mes" class="form-control-admin">
                                @for($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ $m == now()->month ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($m)->locale('es')->monthName }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group-admin">
                            <label class="form-label-admin"><i class="bi bi-calendar-year"></i> Año</label>
                            <select name="anio" class="form-control-admin">
                                @for($a = now()->year; $a >= now()->year - 2; $a--)
                                    <option value="{{ $a }}">{{ $a }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group-admin">
                            <label class="form-label-admin"><i class="bi bi-geo-alt"></i> Sede</label>
                            <select name="sede_id" class="form-control-admin">
                                <option value="">Todas las sedes</option>
                                @foreach($sedes as $sede)
                                    <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn-admin btn-admin-gold">
                            <i class="bi bi-file-earmark-pdf"></i> Descargar PDF
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Accesos rápidos --}}
        <div class="col-md-6">
            <div class="content-card">
                <div class="content-card-header">
                    <h2 class="content-card-title">
                        <i class="bi bi-lightning-charge"></i> Accesos Rápidos
                    </h2>
                </div>
                <div class="content-card-body">
                    <div style="display:flex;flex-direction:column;gap:0.75rem;">
                        @foreach($sedes as $sede)
                            <a href="{{ route('admin.reservaciones.reporte', ['mes' => now()->month, 'anio' => now()->year, 'sede_id' => $sede->id]) }}"
                                target="_blank" class="btn-admin btn-admin-outline" style="justify-content:flex-start;">
                                <i class="bi bi-geo-alt-fill" style="color:var(--color-gold);"></i>
                                {{ $sede->nombre }} — {{ now()->locale('es')->monthName }} {{ now()->year }}
                                <i class="bi bi-download" style="margin-left:auto;"></i>
                            </a>
                        @endforeach

                        <a href="{{ route('admin.reservaciones.reporte', ['mes' => now()->month, 'anio' => now()->year]) }}"
                            target="_blank" class="btn-admin btn-admin-gold" style="justify-content:flex-start;">
                            <i class="bi bi-collection"></i>
                            Todas las sedes — {{ now()->locale('es')->monthName }} {{ now()->year }}
                            <i class="bi bi-download" style="margin-left:auto;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection