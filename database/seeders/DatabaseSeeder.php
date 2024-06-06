<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Concert;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        City::factory(10)->create();
        Concert::factory(10)->create(['description' => 'Описание концерта']);
    }

}
