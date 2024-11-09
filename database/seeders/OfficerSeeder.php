<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class OfficerSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Petugas1',
            'email' => 'petugas1@example.com',
            'role' => 'petugas',
            'password' => bcrypt('password123'),
        ]);
    }
}

