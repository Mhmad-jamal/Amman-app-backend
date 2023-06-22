<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function get(Request $request) {


        $validator = Validator::make($request->all(), [
            'nationalty_number' => 'required|string|exists:clients,nationalty_number',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                'errors' => "1",
                'status' => 201,
            ], 201);
        }
    
        // Validation passed, proceed with retrieving the client
        $nationalty_number = $request->input('nationalty_number');

        $client = Client::where('nationalty_number', $nationalty_number)->first();
    
        // Check if client exists
        if ($client) {
            return response()->json([
                'message' => 'Client found',
                'client' => $client,
                'status' => 200,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Client not found',
                'status' => 404,
            ], 404);
        }
    }
    
    
}
