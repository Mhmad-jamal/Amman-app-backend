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
            'building_area' => 'required|numeric',
            'floor' => 'nullable',
            'construction_age' => 'required',
            'furnished' => 'required',
            'features' => 'required|array',
            'price' => 'required|numeric',
            'ad_title' => 'required',
            'ad_details' => 'required',
            'address' => 'required',
            'status' => 'required|in:0,1,2',
            'owner_id' => 'required|exists:clients,id',
            'image' => 'nullable',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'section.required' => 'حقل القسم مطلوب.',
            'section.in' => 'قيمة حقل القسم يجب أن تكون إما "الإيجار" أو "البيع".',
            'sub_section.required' => 'حقل القسم الفرعي مطلوب.',
            'room_number.required' => 'حقل عدد الغرف مطلوب.',
            'bath_number.required' => 'حقل عدد الحمامات مطلوب.',
            'building_area.required' => 'حقل مساحة المبنى مطلوب.',
            'building_area.numeric' => 'حقل مساحة المبنى يجب أن يكون رقمًا.',
            'floor.nullable' => 'حقل الطابق يجب أن يكون فارغًا أو رقمًا.',
            'construction_age.required' => 'حقل عمر البناء مطلوب.',
            'furnished.required' => 'حقل التجهيز مطلوب.',
            'features.required' => 'حقل الميزات مطلوب.',
            'features.array' => 'حقل الميزات يجب أن يكون مصفوفة.',
            'price.required' => 'حقل السعر مطلوب.',
            'price.numeric' => 'حقل السعر يجب أن يكون رقمًا.',
            'ad_title.required' => 'حقل عنوان الإعلان مطلوب.',
            'ad_details.required' => 'حقل تفاصيل الإعلان مطلوب.',
            'address.required' => 'حقل العنوان مطلوب.',
            'status.required' => 'حقل الحالة مطلوب.',
            'status.in' => 'قيمة حقل الحالة يجب أن تكون إما 0 أو 1 أو 2.',
            'owner_id.required' => 'حقل معرّف المالك مطلوب.',
            'owner_id.exists' => 'معرّف المالك المحدد غير موجود.',
            'image.*.image' => 'حقل الصورة يجب أن يكون صورة.',
            'image.*.mimes' => 'حقل الصورة يجب أن يكون بتنسيقات jpeg أو png أو jpg أو gif.',
            'image.*.max' => 'حجم حقل الصورة يجب أن لا يتجاوز 2048 كيلوبايت.',
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
                    return redirect()->back()->with('error', 'فشل في حفظ الصورة.');

                }
            }
        }
    
        $property = PropertyModel::findOrFail($id);
    
        $property->update($propertyData);
    
        Alert::success('تم بنجاح', 'تم تحديث العقار بنجاح!');




    
        return redirect()->route('properties_edit', ['id' => $id]);
    }
    public function deleteImage(Request $request)
    {
        
        $id = $request->input('id');
        $index = $request->input('index');
        $property = PropertyModel::findOrFail($id);
        $images = json_decode($property->image, true);
    
        if (isset($images[$index])) {
            // Remove the image path from the array
            unset($images[$index]);
            // Re-index the array to avoid gaps in the indices
            $images = array_values($images);
    
            // Update the property model with the updated images array
            $property->image = json_encode($images);
            $property->save();
        }
    
        // Redirect back to the page or any other desired action
        Alert::success('تم بنجاح', 'تم حذف الصورة بنجاح!');





        return redirect()->back();
    }

    public function addImage(Request $request)
    {
        $id = $request->input('id');
        $property = PropertyModel::findOrFail($id);
        $images = json_decode($property->image, true);
    
        // Check if any image files are uploaded
        if ($request->hasFile('image')) {
            $files = $request->file('image');
    
            // Iterate through each file
            foreach ($files as $file) {
                // Validate the file
                if ($file->isValid()) {
                    $imagePath = $file->store('property/images', 'public');
                    $images[] = $imagePath;
                } else {
                    // Handle file upload failure for individual files
                    // You can log an error message or show a notification to the user.
                    Alert::error('Error', 'Failed to upload one or more image files!');
                    return redirect()->back();
                }
            }
    
            // Update the property model with the updated images array
            $property->image = json_encode($images);
            $property->save();
    
            // Success message
            Alert::success('تم بنجاح', 'تم تحميل الصور بنجاح!');




        } else {
            // Handle case when no image files are uploaded
            Alert::error('خطأ', 'لم يتم تحديد ملفات الصور!');




            return redirect()->back();
        }
    
        // Redirect back to the page or any other desired action
        return redirect()->back();
    }
    

    public function delete($id){
        $property = PropertyModel::findOrFail($id);
    
        // Change the property status to 2
        $property->status = '2';
        $property->save();
        Alert::success('تم بنجاح', 'تم حذف العقار بنجاح!');





        // Redirect back to the page or any other desired action
        return redirect()->back();

    }
    public function view_all(){
        return view('property.all-property');

    }
    

 
}
