<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginMobile extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                'status' => 201
            ], 201);
        }
        
        $email = $request->input('email');
        $password = $request->input('password');

        $client = Client::where('email', $email)->first();

        if (!$client) {
            return response()->json([
                'message' => ['password'=>['The provided password is incorrect.']],
                'status' => 201
            ]);
        }

        if (!Hash::check($password, $client->password)) {
            return response()->json([
                'message' => ['password'=>['The provided password is incorrect.']],
                'status' => 201
            ]);
        }

        // Email exists and password matches
        return response()->json([
            'message' => 'Login successful',
            'data' => $client,
            'status' => 200,
        ]);
    }
}