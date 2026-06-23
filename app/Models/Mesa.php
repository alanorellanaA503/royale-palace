<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model {
    protected $table = 'mesas';
    protected $fillable = [
        'sede_id', 'numero', 'capacidad', 'ubicacion', 'activa'
    ];

    public function sede() {
        return $this->belongsTo(Sede::class);
    }

    public function reservaciones() {
        return $this->hasMany(Reservacion::class);
    }

    public function estaDisponible($fecha, $hora) {
        return !$this->reservaciones()
            ->where('fecha', $fecha)
            ->where('hora', $hora)
            ->whereIn('estado', ['pendiente', 'confirmada'])
            ->exists();
    }
}