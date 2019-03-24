<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Question::class, function (Faker $faker) {

    return [
        'title' => rtrim($faker->sentence(rand(3,6),".")),
        'body' => $faker->paragraphs(rand(3,6),true),
        'views' => rand(0,20),
        'answers' => rand(0,20),
        'votes' => rand(-3,20),
    ];
});
