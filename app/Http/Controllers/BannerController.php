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
    public function view()
    {
        $banners = Banner::all();
        return view('banner.view')->with('banners', $banners);
    }
    public function edit()
    {
        $banners = Banner::all();
        return view('banner.edit')->with('banners', $banners);
    }
    public function update(Request $request){

        $id = $request->input('id');
        $href = $request->input('href');
        $banner = Banner::find($id);
        $banner->href = $href;
        $banner->save();
        if (!$banner) {
            return response()->json(['status'=>201,'message' => 'البانر غير موجود'], 404);




        }
        
        if (!$banner->save()) {
            return response()->json(['status'=>201,'message' => 'فشل تحديث البانر'], 500);




        }
        
        return response()->json([
            'status'=>200
            ,'message' => 'تم تحديث البانر بنجاح']);
        }
    public function delete(Request $request)
    {
        $id = $request->input('id');
        
        // Find the banner by ID
        $banner = Banner::find($id);
        
        if (!$banner) {

            Alert::warning('تحذير', 'لم يتم العثور على الصورة!');





            // Banner not found
            
            return redirect()->back();
        }
        
        // Delete the banner
        if ($banner->delete()) {
            Alert::success('تم بنجاح', 'تم حذف الصورة بنجاح!');





            // Banner deleted successfully
            return redirect()->back();
        } else {
            // Failed to delete the banner
            Alert::error('خطأ', 'عذرًا، حدث خطأ ما!');





            return redirect()->back();
        }
    }
   public function create(Request $request)
{
    $validator = Validator::make($request->all(), [
        'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', [
            'required' => 'حقل الصورة مطلوب.',
            'image' => 'يجب أن يكون الملف ملف صورة.',
            'mimes' => 'يجب أن يكون الملف بصيغة jpeg أو png أو jpg أو gif.',
            'max' => 'يجب ألا يتجاوز حجم الملف 2048 كيلوبايت.',
            ],    ]);
    if ($validator->fails()) {
        $errors = $validator->errors();
    
        // Flash the error messages to the session
        Alert::error('خطأ في التحقق', 'يرجى إصلاح الأخطاء التالية:')->footer($errors->all()[0]);




    
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
        Alert::success('تم بنجاح', 'تم حفظ الصور بنجاح!');




    } else {
        // No image is uploaded
        Alert::warning('تحذير', 'لم يتم تحميل أي صورة!');




    }

    return redirect()->back();
}

}    
