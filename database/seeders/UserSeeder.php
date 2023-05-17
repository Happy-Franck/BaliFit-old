<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'zanos admin 1',
            'email' => 'zanos@gmail.com',
            'password' => Hash::make('zanoszanos'),
            'avatar' => 'zanosa1.png',
        ])->assignRole('administrateur');
        User::create([
            'name' => 'zanos admin 2',
            'email' => 'zanos0@gmail.com',
            'password' => Hash::make('zanos0zanos0'),
            'avatar' => 'zanosa2.png',
        ])->assignRole('administrateur');
        User::create([
            'name' => 'zanos coach',
            'email' => 'zanos1@gmail.com',
            'password' => Hash::make('zanos1zanos1'),
            'avatar' => 'zanosc.png',
        ])->assignRole('coach');
        User::create([
            'name' => 'zanos challenger',
            'email' => 'zanos2@gmail.com',
            'password' => Hash::make('zanos2zanos2'),
            'avatar' => 'zanoschallenger.png',
        ])->assignRole('challenger');
    }
}
