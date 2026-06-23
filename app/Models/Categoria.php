<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model {
    protected $table = 'categorias';
    protected $fillable = ['nombre', 'icono', 'orden'];

    public function platos() {
        return $this->hasMany(Plato::class);
    }
}