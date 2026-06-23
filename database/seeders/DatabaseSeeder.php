<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call([
            SedeSeeder::class,
            CategoriaSeeder::class,
            MesaSeeder::class,
            RoleSeeder::class,
            PlatoSeeder::class,
            AdminSeeder::class,
        ]);
    }
}