<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    return [

        //faker factories to creat faker  product details

        'name' => $faker->word,
        'detail' => $faker->paragraph,
        'price' => $faker->numberBetween(100,1000),
        'stock'=> $faker->randomDigit,
        'discount' => $faker->numberBetween(2,30),

        'user_id' =>  function() {

        	return App\User::all() -> random(); //returns a random user id
        },
    ];
});
