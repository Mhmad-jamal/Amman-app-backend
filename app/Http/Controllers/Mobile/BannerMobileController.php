<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerMobileController extends Controller
{

    public function get()
    {
        $banners = Banner::all();
        
        return response()->json([
            'message' => 'Banners retrieved successfully',
            'data' => $banners,
            'status' => 200,
        ]);
    }

    public function counter(Request $request) {
        $id = $request->input('id');
        $banner = Banner::findOrFail($id);
    
        // Increment the views counter by 1
        $banner->views += 1;
    
        // Save the updated value to the database
        $banner->save();
    
        // You can now use the updated views count as needed
        $updatedViews = $banner->views;
        // Return a response or perform additional actions
        return response()->json(['message' => 'Views counter updated successfully','status'=>200]);
    }
    

}
