<?php

use App\Profile;
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
    $characters = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
    $charactersLength = strlen($characters) - 1;
    $profile = Profile::all()->random();
    return [
        'code' 				=> strtoupper( $faker->bothify($string = '###-???-###-???') ),
        'first_name' 		=> $faker->firstName,
        'last_name' 		=> $faker->lastName,
        'email' 			=> $faker->unique()->safeEmail,
        'password' 			=> bcrypt('secret'),
        'profile_id' 		=> $profile->id,
        'remember_token'	=> str_random(10),
    ];
});