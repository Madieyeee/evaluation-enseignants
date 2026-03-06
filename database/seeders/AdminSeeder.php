<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@evaluation.sn',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
    }
}
