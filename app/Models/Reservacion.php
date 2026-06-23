<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model {
    protected $table = 'reservaciones'; // ← agregar esta línea
    
    protected $fillable = [
        'user_id', 'sede_id', 'mesa_id', 'fecha', 'hora',
        'num_personas', 'estado', 'notas', 'codigo'
    ];
   

    protected $casts = [
        'fecha' => 'date',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function sede() {
        return $this->belongsTo(Sede::class);
    }

    public function mesa() {
        return $this->belongsTo(Mesa::class);
    }

    protected static function boot() {
        parent::boot();
        static::creating(function ($reservacion) {
            $reservacion->codigo = 'TRP-' . date('Y') . '-' . str_pad(
                static::count() + 1, 5, '0', STR_PAD_LEFT
            );
        });
    }
}