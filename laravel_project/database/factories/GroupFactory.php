<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Group;
use Faker\Generator as Faker;

$factory->define(Group::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'category' => $faker->randomElement(['study', 'sport', 'diet', 'sleep']),
        'comment' => 'testcomment'
    ];
});
