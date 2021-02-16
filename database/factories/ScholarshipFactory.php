<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Scholarship;
use Faker\Generator as Faker;

$factory->define(Scholarship::class, function (Faker $faker) {
	$title = $faker->unique()->sentence(3);
	$startDate = $faker->date();
	
    return [
        'title' => $title,
        'details' => $faker->paragraph(5),
        'slug' => str_slug($title),
        'uid' => uniqid(true),
        'start_date' => $startDate,
        'end_date' => $faker->dateTimeInInterval($startDate, '+5 days'),
        'venue' => $faker->address(),
        'time' => $faker->time(),
        'image_url' => $faker->imageUrl(),
    ];
});
