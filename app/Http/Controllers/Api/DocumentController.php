<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
       $request->validate([
          'document' => 'required|file|mimes:jpg,jpeg,png|max:2048',
       ]);
    
       $uploadedFile = $request->file('document');
       $extension = $uploadedFile->getClientOriginalExtension();
       $fileName = Str::random(20) . '.' . $extension; 
       $filePath = $uploadedFile->storeAs('public/documents', $fileName); 
    
       $url = asset('storage/documents/' . $fileName); 
    
       // Return response with file URL
       return response()->json([
          'message' => 'Document uploaded successfully',
          'file_url' => $url
       ]);
    }
}
