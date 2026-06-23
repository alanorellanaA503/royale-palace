<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder {
    public function run(): void {
        $admin = User::firstOrCreate(
            ['email' => 'admin@theroyalepalace.sv'],
            [
                'name'     => 'Administrador General',
                'password' => Hash::make('Royale2026!'),
                'sede_id'  => null,
            ]
        );
        $admin->syncRoles(['admin']);
    }
}