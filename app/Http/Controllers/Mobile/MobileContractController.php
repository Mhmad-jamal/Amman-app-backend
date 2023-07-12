<?php

namespace App\Http\Controllers\Mobile;
use Illuminate\Support\Facades\Validator;
use App\Models\Contract;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Payment;
use App\Models\Terminate;



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
        'guarantor_name'=>'string',
        'guarantor_number'=>'string',
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
    public function terminate(Request $request)
    {
        
            try {
            $id = $request->input('id');
            $contract = Contract::findOrFail($id);
    
            $contract->status = 0; // Set the status to 0
    
            $validator = Validator::make($request->all(), [
                'description' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                    'status' => 422, // Unprocessable Entity
                ]);
            }
        
            $contract->status = 0; // Set the status to 0
            $contract->save(); // Save the updated contract
        
            $terminate = new Terminate();
            $terminate->contract_id = $id;
            $terminate->description = $validator->validated()['description'];
            
        
            if ($request->has('image')) {
                $images = $request->file('image');
        
                if (is_array($images)) {
                    $imagePaths = [];
        
                    foreach ($images as $image) {
                        $imagePath = $image->store('terminate/images', 'public');
        
                        if ($imagePath) {
                            $imagePaths[] = $imagePath;
                        } else {
                            return response()->json([
                                'message' => 'Failed to store image',
                                'status' => 200,
                            ]);                }
                    }
        
                    $terminate->image = $imagePaths;
                } else {
                    $imagePath = $images->store('terminate/images', 'public');
        
                    if ($imagePath) {
                        $terminate->image = $imagePath;
                    } else {
                        return response()->json([
                            'message' => 'Failed to store image',
                            'status' => 200,
                        ]);
                    }
                }
            }else {
                $terminate->image="";
            }
            $terminate->save();
        
            // Return the response or redirect as needed
            return response()->json([
                'message' => 'Contract updated successfully',
                'data' => $contract,
                'status' => 200,
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Contract not found',
                'status' => 404,
            ], 404);
        }
    }
 /*         
    $id = $request->input('id');
    $contract = Contract::findOrFail($id);

    // Validate the request data
    $validatedData = $request->validate([
        'description' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $contract->status = 0; // Set the status to 0
    $contract->save(); // Save the updated contract

    $terminate = new Terminate();
    $terminate->contract_id = $id;
    $terminate->description = $validatedData['description'];

    if ($request->hasFile('image')) {
        $image = $request->file('image');

        if ($image->isValid()) {
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/terminate/images', $imageName);

            if ($imagePath) {
                $terminate->image = 'terminate/images/' . $imageName;
            } else {
                return response()->json([
                    'message' => 'Failed to store image.',
                    'status' => 500
                ], 500);
            }
        } else {
            return response()->json([
                'message' => 'Invalid image file.',
                'status' => 400
            ], 400);
        }
    }

    $terminate->save();

    // Return the response or redirect as needed
    return response()->json([
        'message' => 'Contract updated successfully',
        'data' => $contract,
        'status' => 200,
    ]);*/
 

   
    
}
