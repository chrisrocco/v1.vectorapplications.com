<?php

use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::post('/contact', function(Request $request){
    $validator = Validator::make($request->all(), [
        'email' => 'email|required',
        'phone' => 'string|required',
        'name' => 'string|required',
        'business_name' => 'string|required',
        'message' => 'string|required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'INVALID_PARAMS',
            'reasons' => $validator->errors(),
        ], 400);
    }
    

    $data = [
        'client_email' => $request->email,
        'client_name' => $request->name,
        'business_name' => $request->business_name,
        'client_phone' => $request->phone,
        'message_body' => $request->message,
    ];

    Mail::to(config('mail.company.address'), config('mail.company.name'))
        ->send(new Contact($data));

    return response()->json(true);

});