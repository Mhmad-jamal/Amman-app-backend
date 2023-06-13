<?php

namespace App\Http\Controllers\Web;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

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
    public function update(Request $request )
{
    $id = $request->input('id');

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
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $property = PropertyModel::find($id);

  

    $property->update($request->all());
    Alert::success('Success', 'Property updated successfully!');

    return redirect()->route('properties_edit', ['id' => $id]);

}

 
}
