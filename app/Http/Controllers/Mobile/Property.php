<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\PropertyModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class Property extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'section' => 'required|in:Rent,Sale',
            'sub_section' => 'required',
            'room_number' => 'required',
            'bath_number' => 'required',
            'building_area' => 'required',
            'floor' => 'required',
            'construction_age' => 'required',
            'furnished' => 'required',
            'features' => 'required',
            'price' => 'required',
            'ad_title' => 'required',
            'ad_details' => 'required',
            'address' => 'required',
            'status' => 'required|in:0,1,2',
            'owner_id' => 'required|exists:clients,id',
            'electric_bill' => 'nullable',
            'water_bill' => 'nullable',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image files
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                'status' => 201
            ], 201);
        }
    
        $propertyData = $request->except('image');
        $propertyData['image'] = [];
        
        if ($request->has('image')) {
            $images = $request->file('image');
        
            if (is_array($images)) {
                foreach ($images as $image) {
                    $imagePath = $image->store('property/images', 'public');
        
                    if ($imagePath) {
                        $propertyData['image'][] = $imagePath;
                    } else {
                        return response()->json([
                            'message' => 'Failed to store image.',
                            'status' => 500
                        ], 500);
                    }
                }
            } else {
                $imagePath = $images->store('property/images', 'public');
        
                if ($imagePath) {
                    $propertyData['image'][] = $imagePath;
                } else {
                    return response()->json([
                        'message' => 'Failed to store image.',
                        'status' => 500
                    ], 500);
                }
            }
        }
        
        
    
        $propertyData['image'] = json_encode($propertyData['image']); // Encode image paths as JSON
    
        $property = PropertyModel::create($propertyData);
    
        return response()->json([
            'message' => 'Property created successfully',
            'status' => 200,
            'property' => $property,
        ]);
    }
    public function deleteproperty(Request $request) {
        $id=$request->input('id');
            $property = PropertyModel::findOrFail($id);
            
            // Delete the property record
            $property->delete();
            return response()->json([
                'message' => 'Property delete successfully',
                'status' => 200,
          
            ]);
    
        
        
    }
    public function getallproperties()
    {
        $properties = PropertyModel::join('clients', 'properties.owner_id', '=', 'clients.id')
            ->select('properties.*', 'clients.*')
            ->get();
        return response()->json([
            'message' => 'All properties retrieved successfully',
            'status' => 200,
            'properties' => $properties,
        ]);
    }
    public function getallpropertiesSearch(Request $request)
{
    

    $properties = PropertyModel::join('clients', 'properties.owner_id', '=', 'clients.id')
        ->select('properties.*', 'clients.*');

    $filters = [
        'section',
        'sub_section',
        'room_number',
        'bath_number',
        'building_area',
        'floor',
        'construction_age',
        'furnished',
        'features',
        'price',
        'ad_title',
        'ad_details',
        'address',
        'status',
        'owner_id',
        'electric_bill',
        'water_bill',
        'min_price',
        'max_price',
        // Add more field names here
    ];
    
    foreach ($filters as $field) {
        if ($request->has($field)) {
            
            $value = $request->input($field);
            if($field=="min_price" && ($value!=""||$vlaue!=NULL )){
                $properties->where("properties.price", '>=', $value);

            }
            if($field=="max_price" && ($value!=""||$vlaue!=NULL )){
                $properties->where("properties.price", '<=', $value);

            }
            if($value!=""|| $value!=NULL){
            $properties->where("properties.$field", $value);
            }

        }
    }

    
    
    $properties = $properties->get();
    return response()->json([
        'message' => 'All properties retrieved successfully',
        'status' => 200,
        'data' => $properties,
    ]);

   


    // Further processing or returning the results
    // ...
}

    public function getpropertiesbyclientId(Request $request)
    {
        $id = $request->input('owner_id');
        $status = $request->input('status');
        $properties = PropertyModel::where('owner_id', $id);

        if (isset($status)) {
            $properties->where('status', $status);
        }

        $properties = $properties->get();
        return response()->json([
            'message' => 'Properties retrieved successfully',
            'status' => 200,
            'properties' => $properties,
        ]);
    }
    public function getpropertiesbyid(Request $request)
    {
        $id = $request->input('id');

        $properties = PropertyModel::where('id', $id)->get();

        return response()->json([
            'message' => 'Properties retrieved successfully',
            'status' => 200,
            'properties' => $properties,
        ]);
    }

    public function getpropertiesbySection(Request $request)
    {
        $section = $request->input('section');

        $properties = PropertyModel::where('section', $section)->get();

        return response()->json([
            'message' => 'Properties retrieved successfully',
            'status' => 200,
            'properties' => $properties,
        ]);
    }
    public function editpropety(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'section' => 'required|in:Rent,Sale',
            'sub_section' => 'required',
            'room_number' => 'required',
            'bath_number' => 'required',
            'building_area' => 'required',
            'floor' => 'nullable',
            'construction_age' => 'required',
            'furnished' => 'required',
            'features' => 'required|json',
            'price' => 'required',
            'ad_title' => 'required',
            'ad_details' => 'required',
            'address' => 'required',
            'status' => 'required|in:0,1,2',
            'owner_id' => 'required|exists:clients,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                'status' => 201
            ], 201);
        }
        $id = $request->input('id');

        $property = PropertyModel::findOrFail($id);
        $property->update($request->all());

        return response()->json([
            'message' => 'Property updated successfully.',
            'status' => 200,
            'data' => $property
        ], 200);
    }
}
