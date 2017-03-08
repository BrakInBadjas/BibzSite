<?php

/*
 * Buddy Factory
 */
 $factory->define(App\Buddy::class, function (Faker\Generator $faker) {
     return [
        'user_id' => App\User::all()->random()->id,
        'buddy_id' => App\User::all()->random()->id,
        'relation' => $faker->paragraph,
        'created_at' => $faker->dateTimeBetween('-3 years', 'now'),
    ];
 });
