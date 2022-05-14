<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Client;

$factory->define(Client::class, function (Faker $faker) {
    return [
        "name" => $faker->name(),
        "phone"=> $faker->phoneNumber(10),
        "email" => $faker->email(),
        "adresse"=> $faker->address(),
        "type"=> 0
    ];
});
