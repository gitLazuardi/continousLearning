<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class pinpoint_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pinpoints')->insert([
            "name" => 'Pin No.1',
            "address" => 'Testing address 1',
            "city" => 'Bandung',
            "state" => 'IDN',
            "latitude" => 28.452763,
            "longitude" => 81.452763
        ]);

        DB::table('pinpoints')->insert([
            "name" => 'Pin No.2',
            "address" => 'Testing address 2',
            "city" => 'Bandung',
            "state" => 'IDN',
            "latitude" => 28.454763,
            "longitude" => 81.451763
        ]);

        DB::table('pinpoints')->insert([
            "name" => 'Pin No.3',
            "address" => 'Testing address 3',
            "city" => 'Bandung',
            "state" => 'IDN',
            "latitude" => 28.452793,
            "longitude" => 81.452713
        ]);
    }
}
