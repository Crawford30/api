<?php

namespace App\Exceptions;

use App\Exceptions\ExceptionTrait;
//use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{


     use ExceptionTrait; //Using the Trait
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {



        // //HANDLING EXCEPTION

        // if ($exception instanceof ModelNotFoundException) {

        //         return response() -> json('Model Not Found', 404);

        // }


          //Handling incase of a broswer, because of accceptJson in request header
        if ($request -> expectsJson()) {

       //      //HANDLING EXCEPTION

       //  if ($exception instanceof ModelNotFoundException) {

       //          //return response() -> json('Model Not Found', 404); //wrap it inside error

       //          return response() -> json([

       //              'errors' => 'Model Product not found'

       //          ], Response::HTTP_NOT_FOUND); 

       //        }


       //         //ERROR HANDLING FOR INCORRECT URL

       // if ($exception instanceof NotFoundHttpException) {

       //  //return response() -> json('Model Not Found', 404); //wrap it inside error

       //          return response() -> json([

       //              'errors' => 'Incorrect route'

       //          ], Response::HTTP_NOT_FOUND); 

       //        }




            //CALL THE EXCEPTION TRAIT FILE

             return   $this -> apiException($request, $exception);



        }


      // dd($exception); //die and damp the exception

        return parent::render($request, $exception);
    
    }


}
