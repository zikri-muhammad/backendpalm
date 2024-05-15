<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('bookings', function (Blueprint $table) {
         $table->id();
         $table->string('name');
         $table->string('email');
         $table->unsignedBigInteger('country_id'); 
         $table->foreign('country_id')->references('id')->on('countries'); 
         $table->string('phone');
         $table->string('upload_ktp')->nullable(false); 
         $table->integer('surfing_experience')->nullable(false); 
         $table->date('visit_date');
         $table->enum('desired_board', ['longboard', 'funboard', 'shortboard', 'fishboard', 'gunboard'])->nullable(false);
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
      Schema::dropIfExists('bookings');
   }
}
