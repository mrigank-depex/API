<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryCodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('country_codes')->insert([
            ['country_name' => 'United States', 'country_code' => '+1'],
            ['country_name' => 'Canada', 'country_code' => '+1'],
            ['country_name' => 'United Kingdom', 'country_code' => '+44'],
            ['country_name' => 'Australia', 'country_code' => '+61'],
            // Add more country codes here
        ]);
    }
}
