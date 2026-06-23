@extends('layouts.admin')
@section('title', isset($plato) ? 'Editar Platillo' : 'Nuevo Platillo')
@section('topbar-icon', 'egg-fried')
@section('topbar-title', isset($plato) ? 'Editar Platillo' : 'Nuevo Platillo')

@section('content')

    <div class="mb-4">
        <a href="{{ route('admin.platos.index') }}" class="btn-admin btn-admin-outline btn-admin-sm">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <div class="content-card" style="max-width:700px;">
        <div class="content-card-header">
            <h2 class="content-card-title">
                <i class="bi bi-egg-fried"></i>
                {{ isset($plato) ? 'Editar: ' . $plato->nombre : 'Nuevo Platillo' }}
            </h2>
        </div>
        <div class="content-card-body">
            <form method="POST"
                action="{{ isset($plato) ? route('admin.platos.update', $plato) : route('admin.platos.store') }}">
                @csrf
                @if(isset($plato)) @method('PUT') @endif

                <div class="row g-3">
                    <div class="col-md-8">
                        <div class="form-group-admin">
                            <label class="form-label-admin"><i class="bi bi-type"></i> Nombre</label>
                            <input type="text" name="nombre" class="form-control-admin"
                                value="{{ old('nombre', $plato->nombre ?? '') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group-admin">
                            <label class="form-label-admin"><i class="bi bi-currency-dollar"></i> Precio</label>
                            <input type="number" name="precio" step="0.01" min="0" class="form-control-admin"
                                value="{{ old('precio', $plato->precio ?? '') }}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group-admin">
                            <label class="form-label-admin"><i class="bi bi-text-paragraph"></i> Descripción</label>
                            <textarea name="descripcion" class="form-control-admin" rows="3"
                                required>{{ old('descripcion', $plato->descripcion ?? '') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-admin">
                            <label class="form-label-admin"><i class="bi bi-geo-alt"></i> Sede</label>
                            <select name="sede_id" class="form-control-admin" required>
                                @foreach($sedes as $sede)
                                    <option value="{{ $sede->id }}" {{ old('sede_id', $plato->sede_id ?? Auth::user()->sede_id) == $sede->id ? 'selected' : '' }}>
                                        {{ $sede->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-admin">
                            <label class="form-label-admin"><i class="bi bi-tag"></i> Categoría</label>
                            <select name="categoria_id" class="form-control-admin" required>
                                @foreach($categorias as $cat)
                                    <option value="{{ $cat->id }}" {{ old('categoria_id', $plato->categoria_id ?? '') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group-admin">
                            <label class="form-label-admin"><i class="bi bi-toggle-on"></i> Disponible</label>
                            <select name="disponible" class="form-control-admin">
                                <option value="1" {{ old('disponible', $plato->disponible ?? 1) ? 'selected' : '' }}>Sí
                                </option>
                                <option value="0" {{ !old('disponible', $plato->disponible ?? 1) ? 'selected' : '' }}>No
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group-admin">
                            <label class="form-label-admin"><i class="bi bi-award"></i> Es Insignia</label>
                            <select name="es_insignia" class="form-control-admin">
                                <option value="0" {{ !old('es_insignia', $plato->es_insignia ?? 0) ? 'selected' : '' }}>No
                                </option>
                                <option value="1" {{ old('es_insignia', $plato->es_insignia ?? 0) ? 'selected' : '' }}>Sí
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group-admin">
                            <label class="form-label-admin"><i class="bi bi-leaf"></i> Es Temporada</label>
                            <select name="es_temporada" class="form-control-admin">
                                <option value="0" {{ !old('es_temporada', $plato->es_temporada ?? 0) ? 'selected' : '' }}>No
                                </option>
                                <option value="1" {{ old('es_temporada', $plato->es_temporada ?? 0) ? 'selected' : '' }}>Sí
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <button type="submit" class="btn-admin btn-admin-gold">
                            <i class="bi bi-check-circle"></i>
                            {{ isset($plato) ?'Crear Platillo' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection