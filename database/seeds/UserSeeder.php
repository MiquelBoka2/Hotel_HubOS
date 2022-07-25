<?php

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
            'name' => "admin",
            'email' => 'admin@mail.com',
            'password' => Hash::make('123456'),
            'user_type_id' => 1
        ]);

        //API user
        DB::table('users')->insert([
            'name' => "api",
            'email' => 'api@mail.com',
            'password' => Hash::make('123456'),
            'user_type_id' => 2
        ]);
    }
}
