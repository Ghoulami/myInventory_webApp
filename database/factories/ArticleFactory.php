<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\Category;
use App\Stock;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'price' => $faker->randomFloat(2),
        'description' => $faker->realText(200),
        'image_path' => "https://picsum.photos/640/480?random=1",
        'created_at' => now()->toDateTimeString(),
        'updated_at' => "",
        'category_id' => $faker->randomElement(Category::all()->pluck('id')),
        'stock_id' => $faker->randomElement(Stock::all()->pluck('id')),
    ];
});
