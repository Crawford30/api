<?php

namespace App\Model;


use App\Model\Review;

use Illuminate\Database\Eloquent\Model;

class Product extends Model

{


//SINCE WE ARE USING MARK ASSIGNMENT IN THE UPDATE WE USE FILLABLE

	protected $fillable = [

		//we provide the label keys

		'name', 'detail', 'stock', 'price', 'discount'
	];


    //A product can have many reviews// creating relationship

    public function reviews()
    {
    	return $this->hasMany(Review::class); 
    }
}
