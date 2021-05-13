<?php

namespace Database\Seeders;

use App\Models\Agence;
use App\Models\City;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Agence::factory(10)->create();
        City::factory(10)->create();
    }
}
