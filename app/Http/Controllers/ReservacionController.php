<?php
namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Models\Reservacion;
use App\Models\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservacionController extends Controller
{
    public function miCuenta()
{
    $reservaciones = Auth::user()
        ->reservaciones()
        ->with(['sede', 'mesa'])
        ->orderBy('fecha', 'desc')
        ->orderBy('hora', 'desc')
        ->get();

    // Próximas: fecha futura o hoy, en estado activo
    $proximas = $reservaciones->filter(function($r) {
        return $r->fecha >= today() &&
               in_array($r->estado, ['pendiente', 'confirmada']);
    });

    // Historial: pasadas o canceladas/completadas
    $historial = $reservaciones->filter(function($r) {
        return $r->fecha < today() ||
               in_array($r->estado, ['cancelada', 'completada']);
    });

    return view('cuenta.index', compact('reservaciones', 'proximas', 'historial'));
}

    public function create(Request $request)
    {
        $sedes     = Sede::where('activa', true)->get();
        $sedeSlug  = $request->get('sede');
        $sedeSeleccionada = $sedeSlug
            ? Sede::where('slug', $sedeSlug)->first()
            : null;

        return view('reservaciones.create', compact('sedes', 'sedeSeleccionada'));
    }

    public function mesasDisponibles(Request $request)
    {
        $request->validate([
            'sede_id'      => 'required|exists:sedes,id',
            'fecha'        => 'required|date|after_or_equal:today',
            'hora'         => 'required',
            'num_personas' => 'required|integer|min:1|max:8',
        ]);

        $mesas = Mesa::where('sede_id', $request->sede_id)
            ->where('activa', true)
            ->where('capacidad', '>=', $request->num_personas)
            ->get()
            ->map(function ($mesa) use ($request) {
                $ocupada = $mesa->reservaciones()
                    ->where('fecha', $request->fecha)
                    ->where('hora', $request->hora)
                    ->whereIn('estado', ['pendiente', 'confirmada'])
                    ->exists();

                return [
                    'id'        => $mesa->id,
                    'numero'    => $mesa->numero,
                    'capacidad' => $mesa->capacidad,
                    'ubicacion' => $mesa->ubicacion,
                    'disponible'=> !$ocupada,
                ];
            });

        return response()->json($mesas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'sede_id'      => 'required|exists:sedes,id',
            'mesa_id'      => 'required|exists:mesas,id',
            'fecha'        => 'required|date|after_or_equal:today',
            'hora'         => 'required',
            'num_personas' => 'required|integer|min:1|max:8',
            'notas'        => 'nullable|string|max:500',
        ]);

        // Verificar disponibilidad antes de crear
        $mesa = Mesa::findOrFail($request->mesa_id);
        if (!$mesa->estaDisponible($request->fecha, $request->hora)) {
            return back()
                ->withInput()
                ->with('error', 'Lo sentimos, esa mesa ya fue reservada. Por favor selecciona otra.');
        }

        $reservacion = Reservacion::create([
            'user_id'      => Auth::id(),
            'sede_id'      => $request->sede_id,
            'mesa_id'      => $request->mesa_id,
            'fecha'        => $request->fecha,
            'hora'         => $request->hora,
            'num_personas' => $request->num_personas,
            'notas'        => $request->notas,
            'estado'       => 'confirmada',
        ]);

        return redirect()
            ->route('cuenta.index')
            ->with('success', "¡Reservación confirmada! Tu código es: {$reservacion->codigo}");
    }

    public function cancelar(Reservacion $reservacion)
    {
        // Solo el dueño puede cancelar
        if ($reservacion->user_id !== Auth::id()) {
            abort(403);
        }

        // Solo se puede cancelar si es futura
        if ($reservacion->fecha < today()) {
            return back()->with('error', 'No puedes cancelar una reservación pasada.');
        }

        $reservacion->update(['estado' => 'cancelada']);

        return back()->with('success', 'Reservación cancelada correctamente.');
    }

    public function comprobante(Reservacion $reservacion)
{
    // Solo el dueño puede ver su comprobante
    if ($reservacion->user_id !== Auth::id()) {
        abort(403);
    }

    $reservacion->load(['sede', 'mesa', 'user']);
    return view('reservaciones.comprobante', compact('reservacion'));
}


}