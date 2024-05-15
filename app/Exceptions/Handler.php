<?php

namespace App\Exceptions;

use Facade\FlareClient\Http\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
   /**
    * A list of the exception types that are not reported.
    *
    * @var array<int, class-string<Throwable>>
    */
   protected $dontReport = [
      //
   ];

   /**
    * A list of the inputs that are never flashed for validation exceptions.
    *
    * @var array<int, string>
    */
   protected $dontFlash = [
      'current_password',
      'password',
      'password_confirmation',
   ];

   /**
    * Register the exception handling callbacks for the application.
    *
    * @return void
    */
   public function register()
   {
      $this->reportable(function (Throwable $e) {
         //
      });
   }

   /**
    * Convert an authentication exception into a response.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Illuminate\Auth\AuthenticationException  $exception
    * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
    */
   protected function unauthenticated($request, AuthenticationException $exception)
   {
      if ($request->expectsJson()) {
         // Token tidak ditemukan
         if ($exception instanceof TokenInvalidException) {
            return response()->json(['error' => 'Unauthorized. Token not valid'], 401);
         }
         // Token kedaluwarsa
         if ($exception instanceof TokenExpiredException) {
            return response()->json(['error' => 'Unauthorized. Token expired'], 401);
         }
         // Tidak ada token
         return response()->json(['error' => 'Unauthorized. Token not found'], 401);
      }

      return redirect()->guest(route('login'));
   }
}
