<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Maintenance;
use Illuminate\Support\Facades\Storage;

class MaintinanceController extends Controller
{
    //
    

    public function create(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'name'=>'required',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // Set the image validation rules
            'client_id' => 'required|exists:clients,id',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
                'status' => 201,
            ], 201); // Use appropriate status code, such as 422 Unprocessable Entity
        }
    
  // ...
  $data = [
    'type' => $request->type,
    'name'=>$request->name,
    'description' => $request->description,
    'client_id' => $request->client_id,
];

        $data['image'] = [];
    
        if ($request->has('image')) {
            $images = $request->file('image');
    
            if (is_array($images)) {
                foreach ($images as $image) {
                    $imagePath = $image->store('maintenance/images', 'public');
    
                    if ($imagePath) {
                        $data['image'][] = $imagePath;
                    } else {
                        return response()->json([
                            'message' => 'Failed to store image.',
                            'status' => 500
                        ], 500);
                    }
                }
            } else {
                $imagePath = $images->store('maintenance/images', 'public');
    
                if ($imagePath) {
                    $data['image'] = $imagePath;
                } else {
                    return response()->json([
                        'message' => 'Failed to store image.',
                        'status' => 500
                    ], 500);
                }
            }
        }
        $maintenance = Maintenance::create($data);
    
        // Return a response
        return response()->json([
            'message' => 'Maintenance created successfully',
            'maintenance' => $maintenance,
            'status' => 200,
        ], 200);
    }
    
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'name' => 'required',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // Set the image validation rules
            'client_id' => 'required|exists:clients,id',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
                'status' => 201,
            ], 201); // Use appropriate status code, such as 422 Unprocessable Entity
        }
    
        // Retrieve the maintenance record
        $maintenance = Maintenance::findOrFail($id);
    
        // Prepare the data for updating the maintenance record
        $data = [
            'type' => $request->type,
            'name' => $request->name,
            'description' => $request->description,
            'client_id' => $request->client_id,
        ];
    
        // Check if an image is provided
        $data['image'] = [];
    
        if ($request->has('image')) {
            $images = $request->file('image');
    
            if (is_array($images)) {
                foreach ($images as $image) {
                    $imagePath = $image->store('maintenance/images', 'public');
    
                    if ($imagePath) {
                        $data['image'][] = $imagePath;
                    } else {
                        return response()->json([
                            'message' => 'Failed to store image.',
                            'status' => 500
                        ], 500);
                    }
                }
            } else {
                $imagePath = $images->store('maintenance/images', 'public');
    
                if ($imagePath) {
                    $data['image'] = $imagePath;
                } else {
                    return response()->json([
                        'message' => 'Failed to store image.',
                        'status' => 500
                    ], 500);
                }
            }
        }
    
        // Update the maintenance record
        $maintenance->update($data);
    
        // Return a response
        return response()->json([
            'message' => 'Maintenance updated successfully',
            'maintenance' => $maintenance,
            'status'=>200,
        ]);
    }
    

    public function delete($id)
    {
        // Retrieve the maintenance record
        $maintenance = Maintenance::findOrFail($id);
    
        // Delete the maintenance record
        $maintenance->delete();
    
        // Return a response
        return response()->json([
            'message' => 'Maintenance deleted successfully',
        ]);
    }
}
