<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BookingsTableSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      $faker = Faker::create();

      // Generate and insert 20 sets of random data
      for ($i = 0; $i < 20; $i++) {
         DB::table('bookings')->insert([
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'country_id' => $faker->numberBetween(1, 100),
            'phone' => $faker->phoneNumber,
            'upload_ktp' => 'file_path_ktp.jpg',
            'surfing_experience' => $faker->numberBetween(1, 3), // Generate random integer between 1 and 3
            'visit_date' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'desired_board' => $faker->randomElement(['longboard', 'funboard', 'shortboard', 'fishboard', 'gunboard']),
            'created_at' => now(),
            'updated_at' => now(),
         ]);
      }
   }
}
