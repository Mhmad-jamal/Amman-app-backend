<?php

namespace App\Http\Controllers\Mobile;
use Illuminate\Support\Facades\Validator;
use App\Models\Contract;


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
            'due_dates' => 'required|json',
            'image' => 'nullable|image',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
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
            $imagePath =$imagePath;
        }
       
    
        // Create a new contract instance
        $contract = new Contract($validator->validated());
      
        // Assign the image path to the 'image' field of the contract
        $contract->image = $imagePath;
    
        // Save the contract
     
        $contract->save();
        
        // Return a JSON response with the created contract
        return response()->json([
            'message' => 'Contract created successfully',
            'contract' => $contract,
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }
        $contract = Contract::findOrFail($id);
        $contract->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Contract updated successfully',
        ]);
    }
    public function  get(Request $request) {
        $id=$request->input('id');
        $contract = Contract::findOrFail($id);
      
        return response()->json([
            'message' => 'contract retrieved successfully',
            'data' => $contract,
            'status' => 200,
        ]);
    }
    
}
