@extends('layouts.app')
@section('title', 'Mis Favoritos — The Royale Palace')

@push('styles')
    <style>
        .favoritos-hero {
            padding: 80px 0 60px;
            background: linear-gradient(135deg, var(--color-bg-soft) 0%, var(--color-bg) 100%);
            text-align: center;
        }

        .fav-card {
            background: var(--color-bg);
            border: 1px solid var(--color-line);
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .fav-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--color-gold);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .fav-card:hover {
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
            transform: translateY(-4px);
            border-color: var(--color-gold);
        }

        .fav-card:hover::before {
            transform: scaleX(1);
        }
    </style>
@endpush

@section('content')

    <div class="favoritos-hero">
        <div class="container">
            <p class="section-label">Mi Colección</p>
            <h1 class="section-title">MIS FAVORITOS</h1>
            <div class="gold-divider mx-auto"></div>
            <p class="section-subtitle mx-auto mt-3">
                Tus platillos guardados de The Royale Palace
            </p>
        </div>
    </div>

    <section style="padding: 60px 0 100px; background: var(--color-bg-soft);">
        <div class="container">

            @if(session('success'))
                <div style="padding:1rem 1.25rem;background:#E8F5E9;border-left:4px solid var(--color-green);
                                border-radius:8px;font-size:0.82rem;color:#2E7D32;margin-bottom:1.5rem;
                                display:flex;align-items:center;gap:10px;">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
            @endif

            @if($favoritos->isEmpty())
                <div style="text-align:center;padding:5rem 2rem;">
                    <i class="bi bi-heart"
                        style="font-size:4rem;color:var(--color-line);display:block;margin-bottom:1.5rem;"></i>
                    <h2 style="font-size:1rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;margin-bottom:1rem;">
                        Aún no tienes favoritos
                    </h2>
                    <p style="color:var(--color-muted);font-size:0.88rem;max-width:400px;margin:0 auto 2rem;line-height:1.8;">
                        Explora nuestro menú y guarda los platillos que más te gusten dando clic en el corazón.
                    </p>
                    <a href="{{ route('menu.index') }}" class="btn-gold d-inline-flex align-items-center gap-2">
                        <i class="bi bi-book-half"></i> Explorar Menú
                    </a>
                </div>
            @else
                <div class="row g-4">
                    @foreach($favoritos as $fav)
                        @php $plato = $fav->plato; @endphp
                        <div class="col-md-6 col-lg-4">
                            <div class="fav-card">
                                {{-- Insignia --}}
                                @if($plato->es_insignia)
                                    <span style="font-size:0.55rem;font-weight:700;letter-spacing:2px;color:var(--color-gold);
                                                             margin-bottom:0.5rem;display:flex;align-items:center;gap:4px;">
                                        <i class="bi bi-award-fill"></i> PLATILLO INSIGNIA
                                    </span>
                                @endif

                                {{-- Sede y categoría --}}
                                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.75rem;">
                                    <span style="font-size:0.55rem;font-weight:700;letter-spacing:2px;
                                                         text-transform:uppercase;color:var(--color-gold);">
                                        <i class="bi bi-geo-alt me-1"></i>{{ $plato->sede->nombre }}
                                    </span>
                                    <span style="font-size:0.6rem;color:var(--color-muted);">
                                        {{ $plato->categoria->nombre }}
                                    </span>
                                </div>

                                {{-- Nombre --}}
                                <h3 style="font-size:0.9rem;font-weight:800;text-transform:uppercase;
                                                   letter-spacing:1px;color:var(--color-dark);margin-bottom:0.75rem;">
                                    {{ $plato->nombre }}
                                </h3>

                                {{-- Descripción --}}
                                <p style="font-size:0.78rem;color:var(--color-muted);line-height:1.7;
                                                  margin-bottom:1.25rem;flex:1;">
                                    {{ $plato->descripcion }}
                                </p>

                                {{-- Footer --}}
                                <div style="display:flex;justify-content:space-between;align-items:center;
                                                    padding-top:1rem;border-top:1px solid var(--color-line);">
                                    <span style="font-size:1.1rem;font-weight:700;color:var(--color-gold);">
                                        ${{ number_format($plato->precio, 2) }}
                                    </span>
                                    <div style="display:flex;gap:0.5rem;align-items:center;">
                                        <a href="{{ route('menu.sede', $plato->sede->slug) }}" style="font-size:0.6rem;font-weight:700;letter-spacing:2px;
                                                          text-transform:uppercase;color:var(--color-dark);
                                                          text-decoration:none;display:inline-flex;align-items:center;gap:4px;
                                                          transition:color 0.2s;"
                                            onmouseover="this.style.color='var(--color-gold)'"
                                            onmouseout="this.style.color='var(--color-dark)'">
                                            Ver →
                                        </a>
                                        <form method="POST" action="{{ route('favoritos.toggle', $plato) }}">
                                            @csrf
                                            <button type="submit" title="Quitar de favoritos" style="background:none;border:none;cursor:pointer;
                                                                   font-size:1.2rem;color:#EF5350;transition:transform 0.2s;"
                                                onmouseover="this.style.transform='scale(1.2)'"
                                                onmouseout="this.style.transform='scale(1)'">
                                                <i class="bi bi-heart-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-5">
                    <a href="{{ route('menu.index') }}" class="btn-outline-gold d-inline-flex align-items-center gap-2">
                        <i class="bi bi-book-half"></i> Seguir Explorando el Menú
                    </a>
                </div>
            @endif

        </div>
    </section>
@endsection