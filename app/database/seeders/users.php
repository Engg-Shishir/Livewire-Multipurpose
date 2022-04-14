<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Str;
    use Faker\Factory as Faker;


class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            // Create Facker 
            $faker = Faker::create();


            // Create Facker  
            foreach (range(1,2) as $index) {
                DB::table('users')->insert([
                    'name' => $faker->name,
                    'email' => $faker->email,
                    'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi",
                    'role' => "admin",
            ]);
    } 
    }
}
