<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plato;
use App\Models\Sede;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PlatoController extends Controller
{
    public function index()
    {
        $user  = Auth::user();
        $query = Plato::with(['sede', 'categoria']);

        if ($user->sede_id) {
            $query->where('sede_id', $user->sede_id);
        }

        $platos = $query->orderBy('sede_id')->orderBy('categoria_id')->paginate(20);
        return view('admin.platos.index', compact('platos'));
    }

    public function create()
    {
        $sedes      = Sede::where('activa', true)->get();
        $categorias = Categoria::orderBy('orden')->get();
        return view('admin.platos.create', compact('sedes', 'categorias'));
    }

    /**
     * Store - Método único y corregido
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'descripcion'  => 'required|string',
            'precio'       => 'required|numeric|min:0',
            'sede_id'      => 'required|exists:sedes,id',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen'       => 'nullable|image|mimes:jpeg,png,webp,jpg|max:2048',
            'disponible'   => 'boolean',
            'es_insignia'  => 'boolean',
            'es_temporada' => 'boolean',
        ]);

        $datos = $request->only([
            'nombre', 'descripcion', 'precio', 'sede_id', 'categoria_id',
            'disponible', 'es_insignia', 'es_temporada'
        ]);

        // Crear directorio si no existe
        $directorio = public_path('images/platos');
        if (!File::exists($directorio)) {
            File::makeDirectory($directorio, 0755, true);
        }

        // Subida de imagen
        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            $nombre  = time() . '_' . str_replace(' ', '_', $request->nombre) . '.' . $archivo->extension();
            $archivo->move($directorio, $nombre);
            $datos['imagen'] = $nombre;
        }

        Plato::create($datos);

        return redirect()->route('admin.platos.index')
            ->with('success', 'Platillo creado correctamente.');
    }

    public function edit(Plato $plato)
    {
        $sedes      = Sede::where('activa', true)->get();
        $categorias = Categoria::orderBy('orden')->get();
        return view('admin.platos.edit', compact('plato', 'sedes', 'categorias'));
    }

    /**
     * Update - Corregido: usar $request->nombre para el nombre del archivo
     */
    public function update(Request $request, Plato $plato)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'descripcion'  => 'required|string',
            'precio'       => 'required|numeric|min:0',
            'sede_id'      => 'required|exists:sedes,id',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen'       => 'nullable|image|mimes:jpeg,png,webp,jpg|max:2048',
            'disponible'   => 'boolean',
            'es_insignia'  => 'boolean',
            'es_temporada' => 'boolean',
        ]);

        $datos = $request->only([
            'nombre', 'descripcion', 'precio', 'sede_id', 'categoria_id',
            'disponible', 'es_insignia', 'es_temporada'
        ]);

        // Crear directorio si no existe
        $directorio = public_path('images/platos');
        if (!File::exists($directorio)) {
            File::makeDirectory($directorio, 0755, true);
        }

        // Subida de imagen
        if ($request->hasFile('imagen')) {
            // Borrar imagen anterior si existe
            if ($plato->imagen) {
                $rutaAnterior = $directorio . '/' . $plato->imagen;
                if (File::exists($rutaAnterior)) {
                    File::delete($rutaAnterior);
                }
            }
            
            $archivo = $request->file('imagen');
            // Usar $request->nombre (el nuevo nombre) en lugar de $plato->nombre
            $nombre  = time() . '_' . str_replace(' ', '_', $request->nombre) . '.' . $archivo->extension();
            $archivo->move($directorio, $nombre);
            $datos['imagen'] = $nombre;
        }

        $plato->update($datos);

        return redirect()->route('admin.platos.index')
            ->with('success', "Platillo \"{$plato->nombre}\" actualizado correctamente.");
    }

    public function destroy(Plato $plato)
    {
        // Opcional: eliminar también la imagen asociada
        if ($plato->imagen) {
            $rutaImagen = public_path('images/platos/' . $plato->imagen);
            if (File::exists($rutaImagen)) {
                File::delete($rutaImagen);
            }
        }
        
        $plato->delete();
        return back()->with('success', 'Platillo eliminado correctamente.');
    }
}