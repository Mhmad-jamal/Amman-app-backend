<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Client;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function  get(Request $request) {
        $owner_id=$request->input('owner_id');
        $payments = Payment::where('owner_id', $owner_id)->get();
        foreach ($payments as $payment) {
            $owner_data = Client::find($payment->owner_id);
            $client_data = Client::find($payment->client_id);
            // You can access the client name using $owner_data->name and $client_data->name
            $payment['owner_name'] = $owner_data->name;
            $payment['client_name'] = $client_data->name;
        }

         return response()->json([
             'message' => 'Payment retrieved successfully',
             'data' => $payments,

             'status' => 200,
         ]);
     }
     public function updateStatus(Request $request)
     {
         $id = $request->input('id');
         $status=$request->input('status');
         $payment = Payment::find($id);
     
         if (!$payment) {
             return response()->json([
                 'message' => 'Payment not found',
                 'status' => 404,
             ], 404);
         }
         if(isset($_POST['status'])){
            $status = $_POST['status'];
            $payment->status = $status;
        }else {
         $payment->status = 1;
        }
         $payment->save();
     
         return response()->json([
             'message' => 'Payment status updated successfully',
             'status' => 200,
         ], 200);
     }
}
