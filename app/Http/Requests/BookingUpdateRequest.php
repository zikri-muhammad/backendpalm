<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingUpdateRequest extends FormRequest
{
   /**
    * Determine if the user is authorized to make this request.
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
         'name' => 'required|string',
         'email' => 'required|email',
         'country' => 'required|string',
         'phone' => 'required|string',
         'upload_ktp' => 'nullable|string',
         'surfing_experience' => 'required',
         'visit_date' => 'required|date',
         'desired_board' => 'required|string|in:longboard,funboard,shortboard,fishboard,gunboard',
      ];
   }
}
