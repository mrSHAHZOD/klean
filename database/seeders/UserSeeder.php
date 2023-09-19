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
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'jon',
            'email' => 'hihi@gmail.com',
            'password'=> Hash::make('secret'),
        ]);

        $user->roles()->attach([1,3]);

        $user2 = User::create([
            'name' => 'Davron',
            'email' => 'Davrona@gmail.com',
            'password'=> Hash::make('secret'),
        ]);

        $user2->roles()->attach([2]);

    }
}
