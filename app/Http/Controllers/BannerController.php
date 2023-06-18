<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Banner;

use Illuminate\Support\Facades\Storage;


class BannerController extends Controller
{
    //
    public function add()
    {
        $banners = Banner::all();
        return view('banner.add')->with('banners', $banners);
    }

   public function create(Request $request)
{
    $validator = Validator::make($request->all(), [
        'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    if ($validator->fails()) {
        $errors = $validator->errors();
    
        // Flash the error messages to the session
        Alert::error('Validation Error', 'Please fix the following errors:')->footer($errors->all()[0]);
    
        return redirect()->back()->withErrors($errors)->withInput();
    }
    $images = $request->file('image');
    $href=$request->input("href");
   
    if ($images) {
        if (is_array($images)) {
            foreach ($images as $image) {
                // Generate a unique file name for each image
                $fileName = time() . '_' . $image->getClientOriginalName();
    
                // Store the image in the "banner" folder inside the "public" disk
                $image->storeAs('banner', $fileName, 'public');
    
                // Save the image path in the "banner" table
                $banner = new Banner();
                $banner->image = 'banner/' . $fileName; // Store the path as a string
                $banner->href=$href;
                $banner->save();
            }
        } else {
            // Only one image is uploaded
            $fileName = time() . '_' . $images->getClientOriginalName();
    
            // Store the image in the "banner" folder inside the "public" disk
            $images->storeAs('banner', $fileName, 'public');
    
            // Save the image path in the "banner" table
            $banner = new Banner();
            $banner->image = 'banner/' . $fileName; // Store the path as a string
            $banner->href=$href;
            $banner->save();
        }
        Alert::success('Success', 'Image(s) saved successfully!');
    } else {
        // No image is uploaded
        Alert::warning('Warning', 'No image uploaded!');
    }

    return redirect()->back();
}

}    
