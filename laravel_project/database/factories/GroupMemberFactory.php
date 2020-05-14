<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\GroupMember;
use App\Group;
use App\User;
use Faker\Generator as Faker;

$factory->define(GroupMember::class, function (Faker $faker) {
    return [
        'group_id' => function() {
            return factory(App\Group::class)->create()->id;
        },
        'user_id' => function() {
            return factory(App\User::class)->create()->id;
        }
    ];
});
