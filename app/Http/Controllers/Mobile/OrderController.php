<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use App\Models\Client;

class OrderController extends Controller
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
    
         
                $imagePath = $images->store('order/images', 'public');
    
                if ($imagePath) {
                    $data['image'] = $imagePath;
                } else {
                    return response()->json([
                        'message' => 'Failed to store image.',
                        'status' => 500
                    ], 500);
                }
            
        }
        $order = Order::create($data);
    
        // Return a response
        return response()->json([
            'message' => 'order created successfully',
            'order' => $order,
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
        $order = Order::findOrFail($id);
    
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
    
          
                $imagePath = $images->store('order/images', 'public');
    
                if ($imagePath) {
                    $data['image'] = $imagePath;
                } else {
                    return response()->json([
                        'message' => 'Failed to store image.',
                        'status' => 500
                    ], 500);
                }
            
        }
    
        // Update the maintenance record
        $order->update($data);
    
        // Return a response
        return response()->json([
            'message' => 'order updated successfully',
            'order' => $order,
            'status'=>200,
        ]);
    }
    

    public function delete($id)
    {
        // Retrieve the maintenance record
        $order = Order::findOrFail($id);
    
        // Delete the order record
        $order->delete();
    
        // Return a response
        return response()->json([
            'message' => 'Maintenance deleted successfully',
        ]);
    }

    public function view_maintenance_order()  {
        
        $order = Order::where('status', 0)
        ->where('type', 'maintenance')
        ->get();
        $order->map(function ($client) {
        // Perform your desired action on each $client
        // For example, you can add data to each client
        $client->client_name = Client::where('id', $client->client_id)->pluck('name')->first();
        $client->client_nationality_number = Client::where('id', $client->client_id)->pluck('nationalty_number')->first();

        
        return $client;
        
    });
return view('order.maintenance_order')->with('orders',$order);        
    }


    public function details_maintenance_order($id)
    {
        $order = Order::where('id', $id)->first();
        $order->client_name = Client::where('id', $order->client_id)->pluck('name')->first();
        $order->client_nationality_number = Client::where('id', $order->client_id)->pluck('nationalty_number')->first();
        return view('order.maintenance_order_details')->with('order', $order);
    }
    public function updateStatus(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
    
        $Order = Order::findOrFail($id);
        $Order->status = $status;
        $Order->save();
    
        // Additional code if needed
    
        return response()->json([
            'message' => 'Order status change successfully',
            'status' => 200,
        ]);}    

}
