<?php
use Illuminate\Support\Facades\Hash;

$factory->define(App\Core\Users\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => Hash::make('secret'),
        'role_id' => rand(1,4),
    ];
});
