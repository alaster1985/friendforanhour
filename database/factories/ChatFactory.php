<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Chat;
use Faker\Generator as Faker;

$factory->define(Chat::class, function (Faker $faker) {
    return [
        'profile_id' => $faker->numberBetween(1, 6),
        'friend_id' => $faker->numberBetween(1, 6),
        'chat' => $faker->text(197),
    ];
});
