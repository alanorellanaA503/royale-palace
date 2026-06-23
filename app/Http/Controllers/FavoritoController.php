<?php
namespace App\Http\Controllers;

use App\Models\Favorito;
use App\Models\Plato;
use Illuminate\Support\Facades\Auth;

class FavoritoController extends Controller
{
    public function index()
    {
        $favoritos = Auth::user()
            ->favoritos()
            ->with(['plato.sede', 'plato.categoria'])
            ->get();

        return view('favoritos.index', compact('favoritos'));
    }

    public function toggle(Plato $plato)
    {
        $user = Auth::user();
        $existente = $user->favoritos()->where('plato_id', $plato->id)->first();

        if ($existente) {
            $existente->delete();
            $mensaje = "Eliminado de favoritos.";
        } else {
            Favorito::create([
                'user_id'  => $user->id,
                'plato_id' => $plato->id,
            ]);
            $mensaje = "Guardado en favoritos.";
        }

        return back()->with('success', $mensaje);
    }
}