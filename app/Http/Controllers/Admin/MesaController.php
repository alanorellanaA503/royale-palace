<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mesa;
use App\Models\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MesaController extends Controller
{
    public function index()
    {
        $user  = Auth::user();
        $query = Mesa::with('sede');
        if ($user->sede_id) $query->where('sede_id', $user->sede_id);
        $mesas = $query->orderBy('sede_id')->orderBy('numero')->paginate(20);
        return view('admin.mesas.index', compact('mesas'));
    }

    public function create()
    {
        $sedes = Sede::where('activa', true)->get();
        return view('admin.mesas.create', compact('sedes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sede_id'  => 'required|exists:sedes,id',
            'numero'   => 'required|string|max:10',
            'capacidad'=> 'required|integer|min:1|max:20',
            'ubicacion'=> 'required|in:interior,exterior,terraza,privada',
        ]);

        Mesa::create($request->only(['sede_id','numero','capacidad','ubicacion','activa']));

        return redirect()->route('admin.mesas.index')
            ->with('success', 'Mesa creada correctamente.');
    }

    public function edit(Mesa $mesa)
    {
        $sedes = Sede::where('activa', true)->get();
        return view('admin.mesas.edit', compact('mesa', 'sedes'));
    }

    public function update(Request $request, Mesa $mesa)
    {
        $request->validate([
            'sede_id'  => 'required|exists:sedes,id',
            'numero'   => 'required|string|max:10',
            'capacidad'=> 'required|integer|min:1|max:20',
            'ubicacion'=> 'required|in:interior,exterior,terraza,privada',
        ]);

        $mesa->update($request->only(['sede_id','numero','capacidad','ubicacion','activa']));

        return redirect()->route('admin.mesas.index')
            ->with('success', 'Mesa actualizada correctamente.');
    }

    public function destroy(Mesa $mesa)
    {
        $mesa->delete();
        return back()->with('success', 'Mesa eliminada.');
    }
}