<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    $date = $faker->optional()->dateTimeBetween('-1 year', '+1 year');

    return [
        'name' => $faker->unique()->catchPhrase,
        'completion' => $faker->numberBetween(0, 100),
        'estimated_time' => round($faker->numberBetween(0, 300) / 15) * 15,
        'spent_time' => round($faker->numberBetween(0, 300) / 15) * 15,
        'start' => $date,
        'end' => $date,
    ];
});
