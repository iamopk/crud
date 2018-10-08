<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    $gender = array_random(['male', 'female']);
    $city = array_random(\App\City::all()->pluck('id')->toArray());
    $company = array_random(\App\Company::all()->pluck('id')->toArray());
    $job = array_random(\App\Job::all()->pluck('id')->toArray());
    return [
        'name' => $faker->name($gender),
        'second_name' => $faker->lastName,
        'gender' => $gender,
        'suffix' => array_random([$faker->suffix, null]),
        'address' => array_random([$faker->address, null]),
        'phoneNumber' => array_random([$faker->e164PhoneNumber, null]),
        'job_id' => array_random([$job, null]),
        'company_id' => array_random([$company, null]),
        'city_id' => array_random([$city, null]),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => \Carbon\Carbon::now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
