<?php
namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder {
    public function run(): void {
        $categorias = [
            ['nombre' => 'Entradas',   'icono' => '🥗', 'orden' => 1],
            ['nombre' => 'Desayunos',  'icono' => '🍳', 'orden' => 2],
            ['nombre' => 'Almuerzos',  'icono' => '🍽️', 'orden' => 3],
            ['nombre' => 'Cenas',      'icono' => '🌙', 'orden' => 4],
            ['nombre' => 'Postres',    'icono' => '🍮', 'orden' => 5],
            ['nombre' => 'Bebidas',    'icono' => '🥤', 'orden' => 6],
        ];

        foreach ($categorias as $cat) {
            Categoria::create($cat);
        }
    }
}