<?php
namespace Database\Seeders;

use App\Models\Sede;
use Illuminate\Database\Seeder;

class SedeSeeder extends Seeder {
    public function run(): void {
        $sedes = [
            [
                'nombre'    => 'San Salvador',
                'zona'      => 'Centro',
                'direccion' => 'Colonia Escalón, San Salvador',
                'telefono'  => '+503 2200-0001',
                'email'     => 'sansalvador@theroyalepalace.sv',
                'slug'      => 'san-salvador',
                'activa'    => true,
            ],
            [
                'nombre'    => 'Santa Ana',
                'zona'      => 'Occidente',
                'direccion' => 'Av. Independencia, Santa Ana',
                'telefono'  => '+503 2200-0002',
                'email'     => 'santaana@theroyalepalace.sv',
                'slug'      => 'santa-ana',
                'activa'    => true,
            ],
            [
                'nombre'    => 'San Miguel',
                'zona'      => 'Oriente',
                'direccion' => 'Av. Roosevelt, San Miguel',
                'telefono'  => '+503 2200-0003',
                'email'     => 'sanmiguel@theroyalepalace.sv',
                'slug'      => 'san-miguel',
                'activa'    => true,
            ],
        ];

        foreach ($sedes as $sede) {
            Sede::create($sede);
        }
    }
}