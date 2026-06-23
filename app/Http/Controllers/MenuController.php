<?php
namespace App\Http\Controllers;

use App\Models\Sede;
use App\Models\Categoria;
use App\Models\Plato;

class MenuController extends Controller
{
    public function index()
    {
        $sedes = Sede::where('activa', true)->get();
        $categorias = Categoria::orderBy('orden')->get();
        return view('menu.index', compact('sedes', 'categorias'));
    }

    public function sede(Sede $sede)
    {
        $categorias = Categoria::orderBy('orden')->get();
        $platos = Plato::where('sede_id', $sede->id)
            ->where('disponible', true)
            ->with('categoria')
            ->orderBy('categoria_id')
            ->orderBy('orden')
            ->get()
            ->groupBy('categoria.nombre');

        $sedes = Sede::where('activa', true)->get();

        return view('menu.sede', compact('sede', 'categorias', 'platos', 'sedes'));
    }
}