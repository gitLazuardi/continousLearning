<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            "first" => 'Admin',
            "last" => 'Coba',
            "email" => 'admin@test.com',
            "password" => Hash::make("cobacoba"),
        ]);
    }
}
