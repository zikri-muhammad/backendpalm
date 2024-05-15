<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class BookingRequest extends FormRequest
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
         'email' => 'required|email|unique:bookings,email',
         'country_id' => 'required',
         'phone' => 'required|string',
         'upload_ktp' => 'required|string',
         'surfing_experience' => 'required',
         'visit_date' => 'required|date',
         'desired_board' => 'required|string|in:longboard,funboard,shortboard,fishboard,gunboard',
      ];
   }

   // public function messages()
   // {
   //    return [
   //       'name.required' => 'Nama harus diisi.',
   //       'email.required' => 'Email harus diisi.',
   //       // tambahkan pesan kesalahan untuk setiap aturan validasi di sini
   //    ];
   // }

   public function failedValidation(Validator $validator)
   {
      throw new HttpResponseException(response()->json([
         'success'   => false,
         'message'   => 'Validation errors',
         'data'      => $validator->errors()
      ]));
   }
}
