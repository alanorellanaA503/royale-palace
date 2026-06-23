<?php
namespace App\Http\Controllers;

use App\Models\Sede;
use App\Models\Plato;

class HomeController extends Controller
{
    public function index()
    {
        $sedes = Sede::where('activa', true)->get();
        $platosDestacados = Plato::where('es_insignia', true)
            ->orWhere('es_temporada', true)
            ->with(['sede', 'categoria'])
            ->take(6)
            ->get();

        return view('home', compact('sedes', 'platosDestacados'));
    }

    public function sucursales()
    {
        $sedes = Sede::where('activa', true)->get();
        return view('sucursales', compact('sedes'));
    }

    public function nosotros()
    {
        return view('nosotros');
    }

    public function contacto()
    {
        return view('contacto');
    }
}