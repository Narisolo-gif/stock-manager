<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Compte admin fixe pour le testeur
        User::updateOrCreate(
            ['email' => 'admin@stock.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('password'),
            ]
        );
    }
}
