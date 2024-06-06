<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    public function definition(): array
    {
        $faker = \Faker\Factory::create('ru_RU');

        return [
            'name' => $faker->city,
        ];
    }

}
