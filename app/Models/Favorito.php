<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model {
    protected $table = 'favoritos';
    protected $fillable = ['user_id', 'plato_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function plato() {
        return $this->belongsTo(Plato::class);
    }
}