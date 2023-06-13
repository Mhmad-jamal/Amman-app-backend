<?php

namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MobileRegisterController extends Controller
{
    public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'country_code' => 'required',
        'phone' => 'required',
        'nationalty_number' => 'required|unique:clients|min:6|max:10',
        'email' => 'required|email|unique:clients',
        'customer_type' => 'required',
        'password' => 'required|min:6',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => $validator->errors(),
            'status' => 201
        ], 201);
    }

    $client = new Client();
    $client->name = $request->input('name');
    $client->email = $request->input('email');
    $client->password = Hash::make($request->input('password'));

    // Additional fields
    $client->country_code = $request->input('country_code');
    $client->phone = $request->input('phone');
    $client->nationalty_number = $request->input('nationalty_number');
    $client->customer_type = $request->input('customer_type');

    $client->save();

    return response()->json([
        'message' => 'Registration successful',
        'status' => 200
    ], 200);

}

}
