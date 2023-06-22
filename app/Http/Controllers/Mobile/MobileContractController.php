<?php

namespace App\Http\Controllers\Mobile;
use Illuminate\Support\Facades\Validator;
use App\Models\Contract;
use Illuminate\Support\Facades\DB;

use App\Models\Payment;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MobileContractController extends Controller
{
    //
    public function create(Request $request)
{
    // Validate the request data
    $validator = Validator::make($request->all(), [
        'property_id' => 'required|exists:properties,id',
        'owner_id' => 'required|exists:clients,id',
        'client_name' => 'required|string',
        'client_phone' => 'required|string',
        'user_national_number' => 'required|string|exists:clients,nationalty_number',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'clause' => 'required|string',
        'discount' => 'nullable|integer',
        'price' => 'required|integer',
        'due_dates' => 'required',
        'image' => 'nullable|image',
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        return response()->json([
            'message' => $validator->errors(),
            'errors' => "1",
            'status' => 201,
        ], 201);
    }

    // Retrieve the image file from the request
    $image = $request->file('image');
    $imagePath = null;

    // Check if an image was uploaded
    if ($image) {
        // Generate a unique filename for the image
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();

        // Store the uploaded image in the specified directory
        $imagePath = $image->store('contracts', 'public');

        // Assign the complete image path to the $imagePath variable
        $imagePath = $imagePath;
    }

    // Create a new contract instance
    $contract = new Contract($validator->validated());

    // Assign the image path to the 'image' field of the contract
    $contract->image = $imagePath;

    // Save the contract
    $contract->save();

    $paymentarr=json_decode($request->input('due_dates'));
    $client_id = DB::table('clients')
            ->where('nationalty_number', $contract->user_national_number)
            ->value('id');



 foreach ($paymentarr as $key => $value) {
    $paymentData = [
        'owner_id' => $contract->owner_id,
        'client_id' => $client_id,
        'contract_id' => $contract->id,
        'date' => $value->dateFormat, // Set the payment date as the current date
        'amount' => $value->amount,
        'status'=>0,
    ];
    $payment = Payment::create($paymentData);
 }

    // Create a new Payment
   /*  $ */

    // Optionally, perform additional operations or logic related to the payment

    // Return a JSON response with the created contract and payment
    return response()->json([
        'message' => 'Contract created successfully',
        'contract' => $contract,
        'payment' => $payment,
        'status' => 200,
    ], 200);
}

    public function update(Request $request)
    {
        $id=$request->input('id');
        $validator = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => '201',
                'message' => $validator->errors(),
            ]);
        }
        $contract = Contract::findOrFail($id);
        $contract->update($request->all());
        $paymentarr=json_decode($request->input('due_dates'));
        $client_id = DB::table('clients')
                ->where('nationalty_number', $contract->user_national_number)
                ->value('id');
    
    
                foreach ($paymentarr as $key => $value) {
                    $paymentData = [
                        'owner_id' => $contract->owner_id,
                        'client_id' => $client_id,
                        'contract_id' => $contract->id,
                        'date' => $value->dateFormat, // Set the payment date as the current date
                        'amount' => $value->amount,
                        'status' => 0,
                    ];
                    //check if exist update it else create it
                    
                    $payment = Payment::updateOrCreate(['id' => $value->payment_id], $paymentData);
                
                    // If an existing payment was updated, you can perform additional actions here
                    if (!$payment->wasRecentlyCreated) {
                        // Existing payment found and updated
                        // Perform additional actions if needed
                    }
                }
        return response()->json([
            'status' => 200,
            'message' => 'Contract updated successfully',
        ]);
    }
    public function  get(Request $request) {
       $owner_id=$request->input('owner_id');
        $contract = Contract::where('owner_id',$owner_id)->get();
      
        return response()->json([
            'message' => 'contract retrieved successfully',
            'data' => $contract,
            'status' => 200,
        ]);
    }
 

   
    
}
