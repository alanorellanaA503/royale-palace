<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plato extends Model {
    protected $table = 'platos';
   // En app/Models/Plato.php agregar 'imagen' al fillable:
protected $fillable = [
    'sede_id', 'categoria_id', 'nombre', 'descripcion',
    'precio', 'imagen', 'disponible', 'es_temporada',
    'es_insignia', 'orden'
];

    public function sede() {
        return $this->belongsTo(Sede::class);
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    public function favoritoDe() {
        return $this->hasMany(Favorito::class);
    }
}