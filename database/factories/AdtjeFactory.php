<?php

/*
 * Adtje Factory
 */
 $factory->define(App\Adtje::class, function (Faker\Generator $faker) {
     return [
        'user_id' => App\User::all()->random()->id,
        'added_by' => App\User::all()->random()->id,
        'reason' => $faker->sentence,
        'collected' => false,
        'created_at' => $faker->dateTimeBetween('-3 years', 'now'),
    ];
 });

$factory->state(App\Adtje::class, 'collected', function ($faker) {
    return [
        'collected' => true,
    ];
});
