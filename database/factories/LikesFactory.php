<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Like;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
    return [
        'post_id' => function () {
            return factory('App\Post')->create()->id;
        },
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'liked' => $faker->boolean([50])
    ];
});
