<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password'=> bcrypt('123456'),
            ],
            [
                'name' => 'Petugas',
                'email' => 'petugas@gmail.com',
                'role' => 'petugas',
                'password'=> bcrypt('123456'),
            ],
            [
                'name' => 'Pimpinan',
                'email' => 'pimpinan@gmail.com',
                'role' => 'pimpinan',
                'password'=> bcrypt('123456'),
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
