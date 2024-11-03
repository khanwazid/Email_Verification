<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    User::firstOrCreate(
        ['email' => 'admin@example.com'], 
        [
            'name' => 'AdminUser',
            'password' => Hash::make('password'), 
            'role' => 'admin',
        ]
    );
}
}