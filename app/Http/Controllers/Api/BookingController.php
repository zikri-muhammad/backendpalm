<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\BookingUpdateRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BookingController extends BaseController
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(Request $request)
   {
      try {
         $query = Booking::query();

         // Filtering
         if ($request->has('country')) {
            $query->where('country', $request->input('country'));
         }

         // Sorting
         if ($request->has('sort_by')) {
            $sortField = $request->input('sort_by');
            $sortDirection = $request->input('sort_dir', 'asc');
            $query->orderBy($sortField, $sortDirection);
         }

         // Search
         if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($query) use ($searchTerm) {
               $query->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
         }

         // Fetch paginated data
         $perPage = $request->input('per_page', 10);
         $bookings = $query->paginate($perPage);

         return BookingResource::collection($bookings);
      } catch (\Throwable $th) {
         return response()->json(['message' => 'Internal Server Error'], 500);
      }
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(BookingRequest $request)
   {
      try {
         $validatedData = $request->validated();

         $booking = new Booking([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'country_id' => $validatedData['country_id'],
            'phone' => $validatedData['phone'],
            'upload_ktp' => $validatedData['upload_ktp'],
            'surfing_experience' => $validatedData['surfing_experience'],
            'visit_date' => $validatedData['visit_date'],
            'desired_board' => $validatedData['desired_board'],
         ]);

         $booking->save();

         return $this->sendResponse('Booking created successfully', new BookingResource($booking), 201);
      } catch (\Exception $e) {
         return response()->json(['message' => 'Internal Server Error'], 500);
      }
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      try {
         $booking = Booking::findOrFail($id);
         return $this->sendResponse('Bookings', new BookingResource($booking));

      } catch (\Throwable $th) {
         return response()->json(['message' => 'Internal Server Error'], 500);
      }
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(BookingUpdateRequest $request, Booking $booking)
   {
      $validatedData = $request->validated();
      $booking->update($validatedData);
      return $this->sendResponse('Updat Booking Succesfully', new BookingResource($booking));
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      // Find the booking by its ID
      $booking = Booking::findOrFail($id);

      // Delete the booking
      $booking->delete();

      // Return a success response with a custom message
      return response()->json(['message' => 'Booking deleted successfully'], 200);
   }
}
