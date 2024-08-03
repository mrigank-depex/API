<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateFlagUrlsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('country_codes')->insert([
            ['country_name' => 'Ivory Coast', 'country_code' => '+225', 'flag_url' => url('public/flags/Flag_ivory.png')],
            ['country_name' => 'United States', 'country_code' => '+1', 'flag_url' => url('public/flags/Flag_us.png')],
            ['country_name' => 'Canada', 'country_code' => '+1', 'flag_url' => url('public/flags/Flag_ca.png')],
            ['country_name' => 'United Kingdom', 'country_code' => '+44', 'flag_url' => url('public/flags/Flag_gb.png')],
            ['country_name' => 'Australia', 'country_code' => '+61', 'flag_url' => url('public/flags/Flag_au.png')],
            // Add more countries as needed
        ]);
    }
}
