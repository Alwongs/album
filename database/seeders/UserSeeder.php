<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            [
                'name' => 'Friend',
                'email' => 'friend@friend.friend',
                'is_root' => false,
                'role' => 'F',
                'password' => Hash::make('friend1234'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Guest',
                'email' => 'guest@guest.guest',
                'is_root' => false,
                'role' => 'G',
                'password' => Hash::make('guest1234'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Test',
                'email' => 'test@test.test',
                'is_root' => false,
                'role' => 'A',
                'password' => Hash::make('test1234'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}