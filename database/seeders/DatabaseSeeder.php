<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario administrador de Bienestar
        User::firstOrCreate(
            ['email' => 'bienestar@sena.edu.co'],
            [
                'name'     => 'Bienestar al Aprendiz',
                'password' => Hash::make('Bienestar2024*'),
            ]
        );
    }
}
