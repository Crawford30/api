<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Model\Product;
use App\Model\Review;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function index()

    public function index(Product $product)
    {
        //

        //return Review::all();

        //return  $product; //But we dont Product exactly, we want review for the product

        //return $product -> reviews; //from the relationship

        //After transforming, we use the resource review

        return ReviewResource::collection($product -> reviews);
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


    //made Review request with rules, hence instaed of request(Request $request), we use ReviewRequest
   // public function store(Request $request, Product $product)

     public function store(ReviewRequest $request, Product $product)
    {
        //from php artsan list, it accepts the product id, hence we modify store(Request $request) to store(Request $request, Product $product),

        

       // return $product;

        //we need to create the review

        //we have to store a particular review

        $review = new Review($request -> all()); //create a new review



        //connect the review to product, save the review with the product id

        $product -> reviews() -> save($review);


        //return the response

        return response([

            'data' => new ReviewResource($review)



        ],Response::HTTP_CREATED);

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
