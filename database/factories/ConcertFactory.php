<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConcertFactory extends Factory
{
    public function definition(): array
    {
        $faker = \Faker\Factory::create('ru_RU');

        return [
            'description' => $faker->text(6),
            'city_id' => mt_rand(1, 10),
            'singer_id' => mt_rand(1, 4),
            'date' => Carbon::now(),
        ];
    }

}
