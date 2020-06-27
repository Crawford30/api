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

            'stock' => $this -> stock,

            'discount' => $this -> discount



        ];
    }
}
