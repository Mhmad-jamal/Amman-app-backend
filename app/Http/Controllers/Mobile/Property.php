<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\PropertyModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class Property extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'section' => 'required|in:Rent,Sale',
            'sub_section' => 'required',
            'room_number' => 'required|integer',
            'bath_number' => 'required|integer',
            'building_area' => 'required|integer',
            'floor' => 'nullable|integer|min:0|max:8',
            'construction_age' => 'required|integer',
            'furnished' => 'required|in:Yes,No',
            'features' => 'required|json',
            'price' => 'required|integer',
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

        $property = PropertyModel::create($request->all());

        return response()->json([
            'message' => 'Property created successfully',
            'status'=>200,
            'property' => $property,
        ]);
    }

    public function getallproperties()
    {
        $properties = PropertyModel::all();

        return response()->json([
            'message' => 'All properties retrieved successfully',
            'status'=>200,
            'properties' => $properties,
        ]);
    }
    public function getallpropertiesSearch(){
        $id = $request->input('owner_id');
        $status = $request->input('status');
        $properties = PropertyModel::where('owner_id', $id);
        
        if (isset($status)) {
            $properties->where('status', $status);
        }
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
            'status'=>200,
            'properties' => $properties,
        ]);
    }
    public function getpropertiesbyid(Request $request)
    {
        $id = $request->input('id');
        
        $properties = PropertyModel::where('id', $id)->get();
    
        return response()->json([
            'message' => 'Properties retrieved successfully',
            'status'=>200,
            'properties' => $properties,
        ]);
    }

    public function getpropertiesbySection(Request $request)
    {
        $section = $request->input('section');
        
        $properties = PropertyModel::where('section', $section)->get();
    
        return response()->json([
            'message' => 'Properties retrieved successfully',
            'status'=>200,
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
        'building_area' => 'required|integer',
        'floor' => 'nullable',
        'construction_age' => 'required',
        'furnished' => 'required',
        'features' => 'required|json',
        'price' => 'required|integer',
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
