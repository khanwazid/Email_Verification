<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;
use Faker\Factory as Faker;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =Faker::create();
        for($i=1; $i<=50; $i++){
         $profiles = new Profile;
        $profiles->name = $faker->name;
        $profiles->username = $faker->username;
        $profiles->email = $faker->email;
        $profiles->phone = $faker->phonenumber;
        $profiles->password = $faker->password;
        $profiles->save();

        }
      

    }
}
