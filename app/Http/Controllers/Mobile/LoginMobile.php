<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class LoginMobile extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $client = Client::where('email', $email)->first();

        if (!$client) {
            return response()->json([
                'message' => 'The provided email does not exist.',
                'status' => 201
            ]);
        }

        if (!Hash::check($password, $client->password)) {
            return response()->json([
                'message' => 'The provided password is incorrect.',
                'status' => 201
            ]);
        }

        // Email exists and password matches
        return response()->json([
            'message' => 'Login successful',
            'status' => 200,
        ]);
    }
}
