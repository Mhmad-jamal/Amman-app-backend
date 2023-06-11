<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyModel;
use Illuminate\Support\Facades\Validator;


class Property extends Controller
{
    //
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
            'owner' => 'required|exists:clients,id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                'status' => 201
            ], 201);
        }
        $property = Property::create([
            'section' => $request->section,
            'sub_section' => $request->sub_section,
            'room_number' => $request->room_number,
            'bath_number' => $request->bath_number,
            'building_area' => $request->building_area,
            'floor' => $request->floor,
            'construction_age' => $request->construction_age,
            'furnished' => $request->furnished,
            'features' => $request->features,
            'price' => $request->price,
            'ad_title' => $request->ad_title,
            'ad_details' => $request->ad_details,
            'address' => $request->address,
            'status' => $request->status,
            'owner' => $request->owner,
        ]);

        return response()->json([
            'message' => 'Property created successfully',
            'property' => $property,
        ]);
    }
}
