<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('user')->insert([
            [
                'nama' => 'Super Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Jajang',
                'email' => 'ketua@example.com',
                'password' => Hash::make('password'),
                'role' => 'ketua',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Asep',
                'email' => 'distribusi@example.com',
                'password' => Hash::make('password'),
                'role' => 'distribusi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Irma',
                'email' => 'bendahara@example.com',
                'password' => Hash::make('password'),
                'role' => 'bendahara',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Faiz',
                'email' => 'publikasi@example.com',
                'password' => Hash::make('password'),
                'role' => 'publikasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
