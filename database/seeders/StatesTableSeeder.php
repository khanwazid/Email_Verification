<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\State;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            'Saudi Arabia' => ['Riyadh', 'Makkah', 'Eastern Province'],
            'United Arab Emirates' => ['Abu Dhabi', 'Dubai', 'Sharjah'],
           'India' => ['Maharashtra', 'Tamil Nadu', 'Karnataka'],
        ];

        foreach ($states as $country => $stateList) {
            $countryId = Country::where('name', $country)->first()->id;
            foreach ($stateList as $state) {
                State::create([
                    'country_id' => $countryId,
                    'name' => $state,
                ]);
            }
        }
    }
}
