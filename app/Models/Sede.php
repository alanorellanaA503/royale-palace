<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model {
    protected $table = 'sedes';
    protected $fillable = [
        'nombre', 'zona', 'direccion', 'telefono',
        'email', 'imagen', 'slug', 'activa'
    ];

    public function mesas() {
        return $this->hasMany(Mesa::class);
    }

    public function platos() {
        return $this->hasMany(Plato::class);
    }

    public function reservaciones() {
        return $this->hasMany(Reservacion::class);
    }

    public function admins() {
        return $this->hasMany(User::class);
    }
}