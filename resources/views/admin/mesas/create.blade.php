@extends('layouts.admin')
@section('title', 'Nueva Mesa')
@section('topbar-icon', 'table')
@section('topbar-title', isset($mesa) ? 'Editar Mesa' : 'Nueva Mesa')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.mesas.index') }}" class="btn-admin btn-admin-outline btn-admin-sm">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <div class="content-card" style="max-width:500px;">
        <div class="content-card-header">
            <h2 class="content-card-title">
                <i class="bi bi-table"></i>
                {{ isset($mesa) ? 'Editar Mesa: ' . $mesa->numero : 'Nueva Mesa' }}
            </h2>
        </div>
        <div class="content-card-body">
            <form method="POST"
                action="{{ isset($mesa) ? route('admin.mesas.update', $mesa) : route('admin.mesas.store') }}">
                @csrf
                @if(isset($mesa)) @method('PUT') @endif

                <div class="form-group-admin">
                    <label class="form-label-admin"><i class="bi bi-geo-alt"></i> Sede</label>
                    <select name="sede_id" class="form-control-admin" required>
                        @foreach($sedes as $sede)
                            <option value="{{ $sede->id }}" {{ old('sede_id', $mesa->sede_id ?? Auth::user()->sede_id) == $sede->id ? 'selected' : '' }}>
                                {{ $sede->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group-admin">
                    <label class="form-label-admin"><i class="bi bi-hash"></i> Número de Mesa</label>
                    <input type="text" name="numero" class="form-control-admin"
                        value="{{ old('numero', $mesa->numero ?? '') }}" placeholder="Ej: M-01" required>
                </div>

                <div class="form-group-admin">
                    <label class="form-label-admin"><i class="bi bi-people"></i> Capacidad</label>
                    <select name="capacidad" class="form-control-admin" required>
                        @foreach([2, 4, 6, 8, 10, 12] as $cap)
                            <option value="{{ $cap }}" {{ old('capacidad', $mesa->capacidad ?? 4) == $cap ? 'selected' : '' }}>
                                {{ $cap }} personas
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group-admin">
                    <label class="form-label-admin"><i class="bi bi-house-door"></i> Ubicación</label>
                    <select name="ubicacion" class="form-control-admin" required>
                        @foreach(['interior' => 'Salón Interior', 'exterior' => 'Área Exterior', 'terraza' => 'Terraza', 'privada' => 'Sala Privada'] as $val => $label)
                            <option value="{{ $val }}" {{ old('ubicacion', $mesa->ubicacion ?? 'interior') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group-admin">
                    <label class="form-label-admin"><i class="bi bi-toggle-on"></i> Estado</label>
                    <select name="activa" class="form-control-admin">
                        <option value="1" {{ old('activa', $mesa->activa ?? 1) ? 'selected' : '' }}>Activa</option>
                        <option value="0" {{ !old('activa', $mesa->activa ?? 1) ? 'selected' : '' }}>Inactiva</option>
                    </select>
                </div>

                <button type="submit" class="btn-admin btn-admin-gold">
                    <i class="bi bi-check-circle"></i>
                    {{ isset($mesa) ? 'Actualizar Mesa' : 'Crear Mesa' }}
                </button>
            </form>
        </div>
    </div>
@endsection