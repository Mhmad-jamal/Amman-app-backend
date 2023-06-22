<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\CheckClient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function get(Request $request) {


        $validator = Validator::make($request->all(), [
            'nationalty_number' => 'required|string|exists:clients,nationalty_number',
            'check' => 'required',
            'owner_id'=>'required',
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
        $check = $request->input('check');
        $owner_id=$request->input("owner_id");
        $client = Client::where('nationalty_number', $nationalty_number)->first();

        if($check==0){
    
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
                'status' => 201,
            ], 201);
        }
    }
    else {
        $checkClient = CheckClient::where('nationalty_number', $nationalty_number)->latest()->firstOrNew(['nationalty_number' => $nationalty_number]);

        if (!$checkClient->exists) {
            // The record doesn't exist, create a new one
            $checkClient->check_status = 0;
            $checkClient->owner_id = $owner_id;
            $checkClient->save();
            return response()->json([
                'message' => 'Check Request send successfully',
                'check_status' => $checkClient->check_status,
                'status' => 200,
            ], 200);
        }else {
            return response()->json([
                'message' => 'Check  retrive  successfully',
                'check_status' => $checkClient->check_status,
                'client' => $client,

                'status' => 200,
            ], 200);
        }       
    
    }




}
    
    
}
