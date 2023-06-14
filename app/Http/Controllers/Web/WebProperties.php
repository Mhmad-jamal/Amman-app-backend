<?php

namespace App\Http\Controllers\Web;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyModel;

class WebProperties extends Controller
{
    //
    public function view($id)
    {   
         $property = PropertyModel::find($id);

        return view('property.view', ['property' => $property]);
      
    }
    public function edit($id)
    {   
         $property = PropertyModel::find($id);

        return view('property.edit', ['property' => $property]);
      
    }
    public function update(Request $request)
    {
        $id = $request->input('id');
    
        $validator = Validator::make($request->all(), [
            'section' => 'required|in:Rent,Sale',
            'sub_section' => 'required',
            'room_number' => 'required',
            'bath_number' => 'required',
            'building_area' => 'required|integer',
            'floor' => 'nullable',
            'construction_age' => 'required',
            'furnished' => 'required',
            'features' => 'required|array', // Change validation rule to 'array'
            'price' => 'required|integer',
            'ad_title' => 'required',
            'ad_details' => 'required',
            'address' => 'required',
            'status' => 'required|in:0,1,2',
            'owner_id' => 'required|exists:clients,id',
            'image' => 'nullable',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image files
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $propertyData = $request->except('image');
        $propertyData['features'] = json_encode($request->input('features'));

        if ($request->has('image')) {
            $images = $request->file('image');
    
            if (is_array($images)) {
                $imagePaths = [];
    
                foreach ($images as $image) {
                    $imagePath = $image->store('property/images', 'public');
    
                    if ($imagePath) {
                        $imagePaths[] = $imagePath;
                    } else {
                        return redirect()->back()->with('error', 'Failed to store image.');
                    }
                }
    
                $propertyData['image'] = $imagePaths;
            } else {
                $imagePath = $images->store('property/images', 'public');
    
                if ($imagePath) {
                    $propertyData['image'] = [$imagePath];
                } else {
                    return redirect()->back()->with('error', 'Failed to store image.');
                }
            }
        }
    
        $property = PropertyModel::findOrFail($id);
    
        $property->update($propertyData);
    
        Alert::success('Success', 'Property updated successfully!');
    
        return redirect()->route('properties_edit', ['id' => $id]);
    }
    
    

 
}
