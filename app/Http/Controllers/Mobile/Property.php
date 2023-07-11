<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\PropertyModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\LikeProperty;





class Property extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'section' => 'required|in:Rent,Sale',
            'sub_section' => 'required',
            'room_number' => 'required',
            'bath_number' => 'required',
            'building_area' => 'required',
            'floor' => 'required',
            'construction_age' => 'required',
            'furnished' => 'required',
            'features' => 'required',
            'price' => 'required|numeric',
            'ad_title' => 'required',
            'ad_details' => 'required',
            'address' => 'required',
            'status' => 'required|in:0,1,2',
            'owner_id' => 'required|exists:clients,id',
            'electric_bill' => 'nullable',
            'water_bill' => 'nullable',
            'payment_type' => 'nullable',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image files
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                'status' => 201
            ], 201);
        }
    
        $propertyData = $request->except('image');
        $propertyData['image'] = [];
    
        if ($request->has('image')) {
            $images = $request->file('image');
    
            if (is_array($images)) {
                foreach ($images as $image) {
                    $imagePath = $image->store('property/images', 'public');
    
                    if ($imagePath) {
                        $propertyData['image'][] = $imagePath;
                    } else {
                        return response()->json([
                            'message' => 'Failed to store image.',
                            'status' => 500
                        ], 500);
                    }
                }
            } else {
                $imagePath = $images->store('property/images', 'public');
    
                if ($imagePath) {
                    $propertyData['image'][] = $imagePath;
                } else {
                    return response()->json([
                        'message' => 'Failed to store image.',
                        'status' => 500
                    ], 500);
                }
            }
        }

        if ($request->has('id')) {
            $id = $request->input('id');
        
            $property = PropertyModel::findOrFail($id);
        
            if ($request->has('old_image')) {
                $oldImage = json_decode($request->input('old_image'), true);
               
                $propertyData['image'] = array_merge($propertyData['image'], $oldImage);
            }
      
            $propertyData['image'] = json_encode($propertyData['image']); // Encode image paths as JSON
        
            $property->update($propertyData);
        
            return response()->json([
                'message' => 'Property updated successfully',
                'status' => 200,
                'property' => $property,
            ]);
        }
    
        $propertyData['image'] = json_encode($propertyData['image']); // Encode image paths as JSON

        $property = PropertyModel::create($propertyData);
    
        return response()->json([
            'message' => 'Property created successfully',
            'status' => 200,
            'property' => $property,
        ]);
    }
    
    public function deleteproperty(Request $request) {
        $id = $request->input('id');
        $property = PropertyModel::findOrFail($id);
    
        // Change the property status to 2
        $property->status = '2';
        $property->save();
    
        return response()->json([
            'message' => 'Property Delete successfully',
            'status' => 200,
        ]);
    }
    public function deletePropertyImage(Request $request)
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
    
        return response()->json([
            'message' => 'delete image successfully',
            'status' => 200,
            'properties' => $property,
        ]);

    }
    public function getallproperties()
    {
        $properties = PropertyModel::join('clients', 'properties.owner_id', '=', 'clients.id')
        ->select('properties.id as id', 'clients.id as clients_id', 'properties.section', 'properties.sub_section', 'properties.room_number', 'properties.bath_number', 'properties.building_area', 'properties.floor', 'properties.construction_age', 'properties.furnished', 'properties.features', 'properties.price', 'properties.ad_title', 'properties.ad_details', 'properties.address', 'properties.status', 'properties.electric_bill', 'properties.water_bill', 'properties.image', 'properties.owner_id', 'properties.created_at', 'properties.updated_at', 'clients.name', 'clients.country_code', 'clients.phone', 'clients.nationalty_number', 'clients.email', 'clients.customer_type', 'clients.password', 'clients.active')
        ->where('properties.status', '=', '1')
        ->get();


        return response()->json([
            'message' => 'All properties retrieved successfully',
            'status' => 200,
            'properties' => $properties,
        ]);
    }
    public function getallpropertiesSearch(Request $request)
{
    $filters = [
        'section',
        'sub_section',
        'room_number',
        'bath_number',
        'building_area',
        'floor',
        'construction_age',
        'furnished',
        'features',
        'price',
        'ad_title',
        'ad_details',
        'address',
        'status',
        'owner_id',
        'electric_bill',
        'water_bill',
        'min_price',
        'max_price',
        
        // Add more field names here
    ];
    $properties = PropertyModel::join('clients', 'properties.owner_id', '=', 'clients.id')
    ->select( 'properties.*', 'clients.name', 'clients.phone', 'clients.country_code','clients.nationalty_number')
    ->where('properties.status', '!=', '2');



    foreach ($filters as $field) {
        if ($request->has($field)) {
            $value = $request->input($field);

            if ($field == "min_price" && ($value != "" || $value != null)) {
                $properties->where("properties.price", '>=', $value);
            } elseif ($field == "max_price" && ($value != "" || $value != null)) {
                $properties->where("properties.price", '<=', $value);
            } elseif ($value != "" && $value != null && $field != "max_price" && $field != "min_price") {
                $properties->where("properties.$field", $value);
            }
        }
    }
    $order_by = $request->input('order_by');

    if (isset($order_by)) {
        switch ($order_by) {
            case 'newest':
                $properties->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $properties->orderBy('created_at', 'asc');
                break;
            case 'price_low':
                $properties->orderBy('price', 'asc');
                break;
            case 'price_high':
                $properties->orderBy('price', 'desc');
                break;
            // Add more cases for other order by options if needed
            default:
                // Handle invalid order by option
                break;
        }
    }
    $take = $request->input('take');
    if ($take && is_numeric($take)) {
        $properties->take($take);
    }
    $properties = $properties->get();

    return response()->json([
        'message' => 'All properties retrieved successfully',
        'status' => 200,
        'data' => $properties,
    ]);





    // Further processing or returning the results
    // ...
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
            'status' => 200,
            'properties' => $properties,
        ]);
    }
    public function getpropertiesbyid(Request $request)
    {
        $id = $request->input('id');

        $properties = PropertyModel::where('id', $id)->get();

        return response()->json([
            'message' => 'Properties retrieved successfully',
            'status' => 200,
            'properties' => $properties,
        ]);
    }

    public function getpropertiesbySection(Request $request)
    {
        
        $section = $request->input('section');

        $properties = PropertyModel::where('section', $section)->get();

        return response()->json([
            'message' => 'Properties retrieved successfully',
            'status' => 200,
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
            'building_area' => 'required',
            'floor' => 'nullable',
            'construction_age' => 'required',
            'furnished' => 'required',
            'features' => 'required|json',
            'price' => 'required',
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
    public function likeProperty(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id',
            'property_id' => 'required|exists:properties,id',
            // Add validation rules for other columns if needed
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'status' => 201,
                'errors' => $validator->errors(),
            ], 201);
        }
        $client_id = $request->input('client_id');
        $property_id = $request->input('property_id');
    
        $existingLikeProperty = LikeProperty::where('client_id', $client_id)
            ->where('property_id', $property_id)
            ->first();
    
        if ($existingLikeProperty) {
            $existingLikeProperty->delete();
            return response()->json([
                'message' => 'remove  like property successfully',
                'status' => 201,
                'data' => "",
            ]);
        } else {
            $likeProperty = new LikeProperty();
            $likeProperty->client_id = $client_id;
            $likeProperty->property_id = $property_id;
            // Set values for other columns if needed
            $likeProperty->save();
            return response()->json([
                'message' => ' added  like property successfully',
                'status' => 200,
                'data' => $likeProperty
            ]);
        }
    
      
    }
    public function getlikeProperty(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            // Add validation rules for other columns if needed
        ]);
    
        $client_id = $request->input('client_id');
    
        $properties = LikeProperty::join('properties', 'like_property.property_id', '=', 'properties.id')
        ->join('clients', 'properties.owner_id', '=', 'clients.id')
        ->where('like_property.client_id', $client_id)
        ->get(['properties.*', 'clients.name', 'clients.phone','clients.country_code','clients.nationalty_number']);
    
        // Decode the image and features attributes
        $decodedProperties = $properties->map(function ($property) {
            $property->image = json_decode($property->image);
            $property->features = json_decode($property->features);
            return $property;
        });
    
        return response()->json([
            'message' => 'Properties retrieved successfully',
            'status' => 200,
            'data' => $decodedProperties,
        ]);
    }
    
        
}
