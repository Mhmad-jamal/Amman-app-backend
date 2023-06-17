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
    public function add(){
        return view('banner.add');
    }

   public function create(Request $request)
{
    $request->validate([
        'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $images = $request->file('image');

    if ($images) {
        if (is_array($images)) {
            foreach ($images as $image) {
                // Generate a unique file name for each image
                $fileName = time() . '_' . $image->getClientOriginalName();
    
                // Store the image in the "banner" folder inside the "public" disk
                $image->storeAs('banner', $fileName, 'public');
    
                // Save the image path in the "banner" table
                $banner = new Banner();
                $banner->image = ['banner/' . $fileName]; // Store the path in an array
                $banner->save();
            }
        } else {
            // Only one image is uploaded
            $fileName = time() . '_' . $images->getClientOriginalName();
    
            // Store the image in the "banner" folder inside the "public" disk
            $images->storeAs('banner', $fileName, 'public');
    
            // Save the image path in the "banner" table
            $banner = new Banner();
            $banner->image = ['banner/' . $fileName]; // Store the path in an array
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
