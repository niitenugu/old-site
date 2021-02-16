<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\Models\Course;
use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    $title = $faker->unique()->sentence(3);

    return [
        'title' => $title,
        'details' => $faker->paragraph(5),
        'category_id' => Category::inRandomOrder()->first('uid')->uid,
        'uid' => uniqid(true),
        'slug' => str_slug($title),
        'duration' => rand(1, 36),
        'cost' => rand(80000,200000),
        'image_url' => $faker->imageUrl(),
    ];
});
