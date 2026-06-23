<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservacion;
use App\Models\Sede;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservacionAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservacion::with(['user', 'sede', 'mesa']);

        // Filtros
        if ($request->fecha)   $query->where('fecha', $request->fecha);
        if ($request->estado)  $query->where('estado', $request->estado);
        if ($request->sede_id) $query->where('sede_id', $request->sede_id);

        $reservaciones = $query->orderBy('fecha', 'desc')
                               ->orderBy('hora', 'desc')
                               ->paginate(20);

        return view('admin.reservaciones.index', compact('reservaciones'));
    }

    public function cambiarEstado(Request $request, Reservacion $reservacion)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,confirmada,cancelada,completada'
        ]);

        $reservacion->update(['estado' => $request->estado]);

        return back()->with('success', "Reservación {$reservacion->codigo} actualizada a: {$request->estado}");
    }

    public function reporteForm()
    {
        $sedes = Sede::all();
        return view('admin.reportes.form', compact('sedes'));
    }

    public function reporte(Request $request)
    {
        $mes    = $request->mes     ?? now()->month;
        $anio   = $request->anio    ?? now()->year;
        $sedeId = $request->sede_id ?? null;

        $query = Reservacion::with(['user', 'sede', 'mesa'])
            ->whereMonth('fecha', $mes)
            ->whereYear('fecha', $anio);

        if ($sedeId) {
            $query->where('sede_id', $sedeId);
        }

        $reservaciones    = $query->orderBy('sede_id')->orderBy('fecha')->get();
        $sedes            = Sede::all();
        $sedeSeleccionada = $sedeId ? Sede::find($sedeId) : null;

        $pdf = Pdf::loadView('admin.reportes.reservaciones', compact(
            'reservaciones', 'mes', 'anio', 'sedes', 'sedeSeleccionada'
        ))->setPaper('a4', 'landscape');

        $nombreArchivo = $sedeId
            ? "reporte-{$sedeSeleccionada->slug}-{$mes}-{$anio}.pdf"
            : "reporte-todas-sedes-{$mes}-{$anio}.pdf";

        return $pdf->download($nombreArchivo);
    }
}