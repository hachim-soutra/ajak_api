<?php

namespace Database\Seeders;

use App\Models\Admin;
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
        Admin::create([
            'role_id' => 1,
        ]);
        User::factory(5)->create();
        Agence::factory(10)->create();
    }
}
