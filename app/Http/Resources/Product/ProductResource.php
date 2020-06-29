<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            //THIS WILL GIVE A SINGLE DETAIL

            //getting name from the database

            'name' => $this -> name,

            'description' => $this -> detail, //we are using transformer for resource incase may be detail is changed, the api wont break

            'price' => $this -> price,

            'stock' => $this -> stock == 0 ? 'Out of stock' : $this -> stock, //if stock == 0, rint out of stcock 

            'discount' => $this -> discount,

            'totalPrice' => round((1 - ($this -> discount/100)) * $this -> discount, 2),

            'rating' => $this -> reviews -> count() >0 ? round ($this -> reviews -> sum('star')/$this -> reviews -> count(), 2) : "No rating yet",

            'href' => [

                'reviews' => route('reviews.index', $this -> id)
            ]

           



        ];
    }
}
