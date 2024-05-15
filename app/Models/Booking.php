<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
   use HasFactory;

   protected $fillable = [
      'name',
      'email',
      'country_id',
      'phone',
      'upload_ktp',
      'surfing_experience',
      'visit_date',
      'desired_board',
   ];

   protected $dates = ['visit_date'];

   // Relationship with Country model
   public function country()
   {
      return $this->belongsTo(Country::class);
   }
}
