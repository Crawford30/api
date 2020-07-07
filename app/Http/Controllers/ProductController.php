<?php

namespace App\Http\Controllers;



use App\Exceptions\ProductNotBelongsToUser;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Model\Product;
use Auth;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response; //use Auth

class ProductController extends Controller
{

    //TO CREATE A PRODUCT WE NEED AN AUTHENTICATED USER, HENCE WE CREATE A NEW CONSTRUCTOR

    public function __construct () {

       //hence middleware handles authentication

        $this -> middleware('auth:api') -> except('index', 'show'); //we dont it on the index and show page hence we exclude them, hence used in the store method
    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //return Product::all(); //We are returning everything

       // return  ProductCollection::collection(Product::all()); //BUT we want to display few items, Hence we use the product collection resource


         //return new ProductCollection(Product::all());   //NB: the USE of new will transform only one product, hence we mofify to ProductCollection::collection(Product::all());  


       // return  ProductCollection::collection(Product::all());  instaed of product all, we paginate


        return  ProductCollection::collection(Product::paginate(20));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   // public function store(Request $request)

     public function store(ProductRequest $request)
    {
        //THIS IS ONLY FOR AUTHENTICATED USER

        //Now we use the ProductRequest in this controller

        //return "joel";

        //LETS GET NEW PRODUCT

        $product = new Product;

        //SAVING

         $product -> name = $request -> name;

         $product -> detail = $request -> description;

         $product -> stock = $request -> stock;

         $product -> price = $request -> price;

         $product -> discount = $request -> discount;


         $product -> save();


         //WE HAVE TO GET RESPONSE OF CREATED OR ERROR

       // return $request -> all();


         return response(
            [

                'data' => new ProductResource($product) //transformed to new product resource


            ],   Response::HTTP_CREATED //201  //201 for created

         );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //

        //return  $product;

        //WE WRAP THE product in a new product resource(unwraps everything inside the data)==
        //For a single product

        return new ProductResource($product);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //UPDATING PRODUCT



       // return $request -> all();


        //return $product;

        //The request got both the new data that is $request and the old data which is $product

        //USER ID

        $this -> ProductUserCheck($product); 


        //SINCE detail and description and same, we match

        $request['detail'] = $request -> description;

        unset($request['description']); //we have move the data of description into detail


        $product -> update($request -> all()); //since we are using mark assignment we go to product model and add fillable


         return response(
            [

                'data' => new ProductResource($product) //transformed to new product resource


            ],   Response::HTTP_CREATED //201  //201 for created

         );


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
         $this -> ProductUserCheck($product); 

       // return $product;

        $product -> delete();

        return response(null, Response::HTTP_NO_CONTENT ); //No content
    }



    //FUNCTION TO CHECK THAT A PRODUCT BEING UPDATED BELONGS TO THAT USER

    public function ProductUserCheck($product) { //needs to accept product in its parameter

        if (Auth::id() !== $product -> user_id) {

            //if true, throw a new exception

            throw new ProductNotBelongsToUser;
            
        }

    }
}