@extends('layouts.app')
@section('title', 'Sucursales — The Royale Palace')
@section('content')
    <div class="container" style="padding: 80px 0;">
        <p class="section-label text-center">Nuestras Sedes</p>
        <h1 class="section-title text-center">SUCURSALES</h1>
        <div class="gold-divider mx-auto mb-5"></div>
        <div class="row g-4">
            @foreach($sedes as $sede)
                <div class="col-md-4">
                    <div style="border: 0.5px solid var(--color-line); padding: 2rem; text-align:center;">
                        <h3
                            style="font-size:0.8rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--color-gold);margin-bottom:1rem;">
                            {{ $sede->zona }}
                        </h3>
                        <h2 style="font-size:1.4rem;font-weight:800;text-transform:uppercase;margin-bottom:1rem;">
                            {{ $sede->nombre }}
                        </h2>
                        <p style="color:var(--color-muted);font-size:0.85rem;line-height:1.8;">
                            {{ $sede->direccion }}<br>
                            {{ $sede->telefono }}
                        </p>
                        <a href="{{ route('menu.sede', $sede->slug) }}" class="btn-gold d-inline-block mt-3"
                            style="font-size:0.6rem;padding:10px 24px;">
                            Ver Menú
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection