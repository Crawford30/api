<?php 
namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Component\HttpFoundation\Response;



trait ExceptionTrait {


	public function apiException($request, $e) {



		  //HANDLING EXCEPTION

       // if ($e instanceof ModelNotFoundException) {


       	 if ($this -> isModel($e)) {

                //return response() -> json('Model Not Found', 404); //wrap it inside error

                // return response() -> json([

                //     'errors' => 'Model Product not found'

                // ], Response::HTTP_NOT_FOUND); 





       	 	return $this -> ModelResponse($e);

              }


               //ERROR HANDLING FOR INCORRECT URL

    	if ($this -> isHTTP($e)) {

        //return response() -> json('Model Not Found', 404); //wrap it inside error

                // return response() -> json([

                //     'errors' => 'Incorrect route'

                // ], Response::HTTP_NOT_FOUND); 


    		return $this -> HTTPResponse($e);

              }

              //IF THE EXCEPTIONS IS NOT ONE OF ABOVE< RETURN NORMAL EXCEPTION
              // dd($exception); //die and damp the exception

       			 return parent::render($request, $e);
        
	}



	//function for  model Not found

	protected function isModel($e) {

		return $e instanceof ModelNotFoundException;

	}


		//HTTP EXCEPTION
	protected function isHTTP($e) {

		return $e instanceof NotFoundHttpException;

	}


	//Model Response
	protected function ModelResponse($e) {

		return response() -> json([

                    'errors' => 'Model Product not found'

                ], Response::HTTP_NOT_FOUND); 

	}

	//HTTP RESPONSE


	protected function HTTPResponse($e) {

		return response() -> json([

                    'errors' => 'Incorrect route'

                ], Response::HTTP_NOT_FOUND);  

	}



}