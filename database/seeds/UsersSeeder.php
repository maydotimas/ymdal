<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => Str::random(10),
            'last_name' => Str::random(10),
            'role' => 1,
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'first_name' => Str::random(10),
            'last_name' => Str::random(10),
            'role' => 2,
            'email' => 'encoder@mail.com',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'first_name' => Str::random(10),
            'last_name' => Str::random(10),
            'role' => 3,
            'email' => 'cs@mail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
