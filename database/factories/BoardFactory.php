<?php

use Faker\Generator as Faker;
use App\User;
use App\Board;

$factory->define(App\Board::class, function (Faker $faker) {
    $minId = User::min('id');
    $maxId = User::max('id');
   
    return [
        'title' =>$faker->word(10),
        'content' => $faker->sentence,
        'user_id' => $faker->numberBetween($minId,$maxId)
    ];
});
