<?php

/*
 * Quote Factory
 */
 $factory->define(App\Quote::class, function (Faker\Generator $faker) {
    return [
        'user_id' => App\User::all()->random()->id,
        'quote' => $faker->paragraph,
    ];
});
