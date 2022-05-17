<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $pass = Hash::make("12345");

        $user = \App\Models\User::create([
            "name" => "Agus Hermawan",
            "id_card_number" => "12345",
            "born_date" => "2003-04-21",
            "address" => "Tegal",
            "role" => "Doctor",
            "gender" => "Male",
            "regional_id" => 1,
            "consultation_status" => 0,
            "password" => $pass
        ]);

        $regional = \App\models\Region::create([
            "province" => "Jawa Tengah",
            "district" => "Semarang"
        ]);

        return [$regional , $user];



    }
}
