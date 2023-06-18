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
}
