<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    //===================VALIDATION===================


    /**
     * Determine if the user is authorized to make this request.

     //GOT AFTER RUNNING php artisan make:request ProductRequest
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //PRODUCT NAME SHOULD BE REQUIRED

            'name' => 'required|max:255|unique:products', //name has to be unique for products table
            'description' => 'required',
            'price' => 'required|max:10',
            'stock' => 'required|max:6',
            'discount' => 'required|max:2',
        ];
    }
}
