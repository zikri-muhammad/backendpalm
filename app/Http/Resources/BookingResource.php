<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
   /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    */
   public function toArray($request)
   {
      return [
         'id' => $this->id,
         'name' => $this->name,
         'email' => $this->email,
         'country' => $this->country,
         'phone' => $this->phone,
         'upload_ktp' => $this->upload_ktp,
         'surfing_experience' => $this->surfing_experience,
         'visit_date' => $this->visit_date,
         'desired_board' => $this->desired_board,
         'created_at' => $this->created_at,
         'updated_at' => $this->updated_at,
      ];
   }
}
