<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function  get(Request $request) {
        $owner_id=$request->input('owner_id');
         $Payment = Payment::where('owner_id',$owner_id)->get();
       
         return response()->json([
             'message' => 'Payment retrieved successfully',
             'data' => $Payment,
             'status' => 200,
         ]);
     }
     public function updateStatus(Request $request)
     {
         $id = $request->input('id');
         
         $payment = Payment::find($id);
     
         if (!$payment) {
             return response()->json([
                 'message' => 'Payment not found',
                 'status' => 404,
             ], 404);
         }
     
         $payment->status = 1;
         $payment->save();
     
         return response()->json([
             'message' => 'Payment status updated successfully',
             'status' => 200,
         ], 200);
     }
}
