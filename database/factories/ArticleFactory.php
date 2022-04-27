<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'price' => $faker->randomFloat(2),
        'description' => $faker->realText(200),
        'image_path' => $faker->imageUrl($width = 640, $height = 480),
    ];
});
