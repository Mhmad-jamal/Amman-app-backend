<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyModel extends Model
{
    protected $table = "properties";
    
    protected $fillable = [
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
        'payment_type',
        'image',
    ];
    
    protected $casts = [
        'features' => 'json',
        'image' => 'json',
    ];
    
    public function owner()
    {
        return $this->belongsTo(Client::class, 'owner_id');
    }
}
