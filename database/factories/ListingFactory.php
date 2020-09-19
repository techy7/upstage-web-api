<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Listing;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Listing::class, function (Faker $faker) {
    $user = User::inRandomOrder()->where('role','user')->first();
    return [
        'name' => $faker->realText($maxNbChars = 59),
        'description' => $faker->realText($maxNbChars = 300),
        'user_id' => $user->id,
    ];
});
