<?php

/*
 * User Factory
 */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'address' => $faker->address,
        'mobile_number' => $faker->e164PhoneNumber,
        'remember_token' => 'faker_'.str_random(10),
        'email_token' => 'faker_'.str_random(20),
    ];
});

$factory->state(App\User::class, 'email_verified', function ($faker) {
    return [
        'verified' => true,
        'email_token' => null,
    ];
});
