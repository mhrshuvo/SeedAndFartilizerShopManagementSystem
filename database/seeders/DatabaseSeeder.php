<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void

    {
        $this->call([
        //    CategoriesSeeder::class,
        //    AttributeSeeder::class,
            DistrictsSeeder::class,
            DivisionsSeeder::class
         ]);
        \App\Models\User::factory()->create([
            'name' => 'agri-manager',
            'email' => '18103361@iubat.edu',
            'password' =>bcrypt('password'),
            'phone_no' => '00',
            'role' => 0,
            'otp' => 1234
        ]);


    }
}
