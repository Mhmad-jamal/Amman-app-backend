<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function create(Request $request)
    {

        $validator = $request->validate([
            'owner_id' => 'required|exists:clients,id',
            'client_id' => 'required|exists:clients,id',
            'contract_id' => 'required|exists:contracts,id',
            'date' => 'required|date',
            'amount' => 'required|numeric',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'data' => $validator->errors(),
                'status' => 201,
            ]);
        }

        // Create a new Payment
        $Payment = Payment::create($validatedData);

        // Optionally, perform additional operations or logic related to the payment

        // Return a response or redirect as needed
        return response()->json([
            'message' => 'Payment saved successfully',
            'data' => $Payment,
            'status'=>200,
        ]);
    }
}
