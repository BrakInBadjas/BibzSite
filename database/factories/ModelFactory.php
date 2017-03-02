<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/*
 * User Factory
 */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
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

/*
 * Adtje Factory
 */

$factory->define(App\Adtje::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => 'faker_'.str_random(10),
        'email_token' => 'faker_'.str_random(20),
    ];
});
