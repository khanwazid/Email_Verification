<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = ['Saudi Arabia', 'United Arab Emirates', 'India'];
        foreach ($countries as $country) {
            Country::firstOrCreate(['name' => $country]);
    }
}
}







