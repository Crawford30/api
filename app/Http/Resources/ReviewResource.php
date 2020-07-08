<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);

        //since we dont want the product exacly

        return [

            'id' => $this -> id, //for updating

            'customer' => $this -> customer,
            //review body 

            'body' => $this -> review,

            'star' => $this -> star


        ];



    }
}
