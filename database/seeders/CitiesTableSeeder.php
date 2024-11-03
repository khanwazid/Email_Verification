<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;
use App\Models\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            'Riyadh' => ['Riyadh City', 'Diriyah', 'Al-Kharj'],
            'Makkah' => ['Mecca', 'Jeddah', 'Taif'],
            'Eastern Province' => ['Dammam', 'Khobar', 'Dhahran'],
            'Abu Dhabi' => ['Abu Dhabi City', 'Al Ain', 'Ruwais'],
            'Dubai' => ['Dubai City', 'Palm Jumeirah', 'Deira'],
            'Sharjah' => ['Sharjah City', 'Khor Fakkan', 'Kalba'],
            'Maharashtra' => ['Mumbai', 'Pune', 'Nagpur'],
            'Tamil Nadu' => ['Chennai', 'Coimbatore', 'Madurai'],
            'Karnataka' => ['Bangalore', 'Mysore', 'Hubli'],
        ];

        foreach ($cities as $state => $cityList) {
            $stateId = State::where('name', $state)->first()->id;
            foreach ($cityList as $city) {
                City::firstOrCreate([
                    'state_id' => $stateId,
                    'name' => $city,
                ]);
            }
        }
    }
}
