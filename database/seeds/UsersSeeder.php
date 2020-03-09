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
            'first_name' => ucwords(Str::random(10)),
            'last_name' => ucwords(Str::random(10)),
            'role' => 'ADMIN',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'first_name' => ucwords(Str::random(10)),
            'last_name' => ucwords(Str::random(10)),
            'role' => 'ENCODER',
            'email' => 'encoder@mail.com',
            'password' => Hash::make('password'),
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'first_name' => ucwords(Str::random(10)),
            'last_name' => ucwords(Str::random(10)),
            'role' => 'CS',
            'email' => 'cs@mail.com',
            'password' => Hash::make('password'),
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
