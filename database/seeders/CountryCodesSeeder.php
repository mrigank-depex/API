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
            ['country_name' => 'Ivory Coast', 'country_code' => '+255', 'flag_url' => 'base_url()/public/ivory.png'],
            ['country_name' => 'United States', 'country_code' => '+1', 'flag_url' => 'base_url()/public/us.png'],
            ['country_name' => 'Canada', 'country_code' => '+1', 'flag_url' => 'base_url()/public/ca.png'],
            ['country_name' => 'United Kingdom', 'country_code' => '+44', 'flag_url' => 'base_url()/public/gb.png'],
            ['country_name' => 'Australia', 'country_code' => '+61', 'flag_url' => 'base_url()/public/au.png'],
            // Add more countries as needed
        ]);
    }
}
