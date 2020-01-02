<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\League;
use Faker\Generator as Faker;

$factory->define(League::class, function (Faker $faker) {
    return [
        'leagueName' => $faker->title,
        'description' => $faker->paragraph,
        'owner_id' => 1
    ];
});
