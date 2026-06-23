<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservacion;
use App\Models\Mesa;
use App\Models\Plato;
use App\Models\User;
use App\Models\Sede;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    $reservacionesHoy  = Reservacion::whereDate('fecha', today())
                            ->whereIn('estado', ['pendiente','confirmada'])->count();
    $reservacionesMes  = Reservacion::whereMonth('fecha', now()->month)->count();
    $mesasOcupadas     = Mesa::where('activa', true)->count();
    $platosDisponibles = Plato::where('disponible', true)->count();
    $clientesRegistrados = User::role('usuario')->count();
    $ultimasReservaciones = Reservacion::with(['user','mesa','sede'])
                                ->latest()->take(8)->get();

    return view('admin.dashboard', compact(
        'reservacionesHoy', 'reservacionesMes',
        'mesasOcupadas', 'platosDisponibles',
        'clientesRegistrados', 'ultimasReservaciones'
    ));
}
}