<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
   /**
    * Send a success response.
    *
    * @param  string|array $message
    * @param  mixed $data
    * @param  int $statusCode
    * @return \Illuminate\Http\JsonResponse
    */
   public function sendResponse($message, $data = null, $statusCode = 200)
   {
      $response = [
         'success' => true,
         'message' => $message,
      ];

      if (!is_null($data)) {
         $response['data'] = $data;
      }

      return response()->json($response, $statusCode);
   }

   /**
    * Send an error response.
    *
    * @param  string|array $errorMessages
    * @param  int $statusCode
    * @return \Illuminate\Http\JsonResponse
    */
   public function sendError($errorMessages, $statusCode = 422)
   {
      $response = [
         'success' => false,
         'message' => 'Validation error',
      ];

      if (is_array($errorMessages)) {
         $response['errors'] = $errorMessages;
      } else {
         $response['message'] = $errorMessages;
      }

      return response()->json($response, $statusCode);
   }
}
