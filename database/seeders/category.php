<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            "name" => 'Adventure',
            "slug" => 'Coba',
        ]);
        DB::table('category')->insert([
            "name" => 'Action',
            "slug" => 'Coba',
        ]);
        DB::table('category')->insert([
            "name" => 'Crime',
            "slug" => 'Coba',
        ]);
        DB::table('category')->insert([
            "name" => 'Horror',
            "slug" => 'Coba',
        ]);
        DB::table('category')->insert([
            "name" => 'Documenter',
            "slug" => 'Coba',
        ]);
        DB::table('category')->insert([
            "name" => 'Sci-Fi',
            "slug" => 'Coba',
        ]);
        DB::table('category')->insert([
            "name" => 'Anime',
            "slug" => 'Coba',
        ]);
    }
}
