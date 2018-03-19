<?php

use Faker\Generator as Faker;
use App\Users;
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

$factory->define(App\Users::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'is_admin'=>$faker->boolean,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Actors::class, function (Faker $faker) {
    return [
        'admin_id' => $faker->admin_id,
        'name' => $faker->name,
        'information' => $faker->information ,// secret
        'image_path' =>$faker->image_path,
    ];
});