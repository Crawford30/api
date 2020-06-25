<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('product_id') -> unsigned() -> index(); //get from the product table

            $table->foreign('product_id') -> references('id') -> on('products') -> onDelete('cascade');  //if a product is deleted review will be deleted automatically

            $table->string('customer'); //we need a customer for review

            $table->text('review'); //original review

            $table->integer('star');   //rating from 1 to 5

            $table->timestamps();

           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
 














 