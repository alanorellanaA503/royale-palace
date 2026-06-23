<?php
namespace Database\Seeders;

use App\Models\Mesa;
use App\Models\Sede;
use Illuminate\Database\Seeder;

class MesaSeeder extends Seeder {
    public function run(): void {
        $sedes = Sede::all();

        foreach ($sedes as $sede) {
            // 5 mesas de 2 personas
            for ($i = 1; $i <= 5; $i++) {
                Mesa::create([
                    'sede_id'   => $sede->id,
                    'numero'    => 'M-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                    'capacidad' => 2,
                    'ubicacion' => 'interior',
                    'activa'    => true,
                ]);
            }
            // 5 mesas de 4 personas
            for ($i = 6; $i <= 10; $i++) {
                Mesa::create([
                    'sede_id'   => $sede->id,
                    'numero'    => 'M-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                    'capacidad' => 4,
                    'ubicacion' => 'interior',
                    'activa'    => true,
                ]);
            }
            // 3 mesas de terraza
            for ($i = 11; $i <= 13; $i++) {
                Mesa::create([
                    'sede_id'   => $sede->id,
                    'numero'    => 'M-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                    'capacidad' => 6,
                    'ubicacion' => 'terraza',
                    'activa'    => true,
                ]);
            }
            // 2 mesas privadas
            for ($i = 14; $i <= 15; $i++) {
                Mesa::create([
                    'sede_id'   => $sede->id,
                    'numero'    => 'M-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                    'capacidad' => 8,
                    'ubicacion' => 'privada',
                    'activa'    => true,
                ]);
            }
        }
    }
}