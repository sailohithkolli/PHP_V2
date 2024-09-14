<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
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
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $exception
	 * @return void
	 */
	//public function report(Exception $exception)
	public function report(Throwable $exception)
	{
		parent::report($exception);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $exception
	 * @return \Illuminate\Http\Response
	 */
	//public function render($request, Exception $exception)
	public function render($request, Throwable $exception)
	{
		if ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) 
		{
			abort(404, 'Page Not Found');
		}
		if($exception instanceof \Illuminate\Auth\Access\AuthorizationException)
		{
			abort(401, 'Unauthorized');
		}

		if($exception instanceof \Yajra\Pdo\Oci8\Exceptions\Oci8Exception)
		{
			abort(500, 'Oci8Exception');
		}

		/*
		   if($exception instanceof \Yajra\Pdo\Oci8\Exceptions\Oci8Exception)
		   {
		   abort(500, 'Oracle: A database connection error has occurred.');
		   }

		   if($exception instanceof \Illuminate\Database\QueryException)
		   {
		   abort(500, 'A database connection error has occurred.');
		   }
		 */  
		return parent::render($request, $exception);

	}//end of render function
}//end of class

