<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $query = User::withCount('reservaciones')
                     ->whereDoesntHave('roles', fn($q) => $q->where('name', 'admin'));

        if ($request->buscar) {
            $query->where(function($q) use ($request) {
                $q->where('name',  'like', "%{$request->buscar}%")
                  ->orWhere('email', 'like', "%{$request->buscar}%");
            });
        }

        $usuarios = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function destroy(User $usuario)
    {
        // Proteger que no se borre a sí mismo ni al admin
        if ($usuario->hasRole('admin')) {
            return back()->with('error', 'No puedes eliminar al administrador.');
        }

        $usuario->delete();
        return back()->with('success', "Usuario eliminado correctamente.");
    }

    // Métodos requeridos por resource pero no usados
    public function create()  { return redirect()->route('admin.usuarios.index'); }
    public function store()   { return redirect()->route('admin.usuarios.index'); }
    public function show()    { return redirect()->route('admin.usuarios.index'); }
    public function edit()    { return redirect()->route('admin.usuarios.index'); }
    public function update()  { return redirect()->route('admin.usuarios.index'); }
}