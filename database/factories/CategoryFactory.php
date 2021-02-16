<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
	$name = $faker->unique()->sentence(3);
	
    return [
        'name' => $faker->unique()->sentence(3),
        'description' => $faker->paragraph(5),
        'slug' => str_slug($name),
        'uid' => uniqid(true),
    ];
});
