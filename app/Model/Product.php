<?php

namespace App\Model;


use App\Model\Review;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //A product cab have many reviews// creating relationship

    public function reviews()
    {
    	return $this->hasMany(Review::class); 
    }
}
