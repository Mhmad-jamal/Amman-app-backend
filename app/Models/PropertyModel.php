<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
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
    ];

    protected $casts = [
        'features' => 'json',
    ];

    public function owner()
    {
        return $this->belongsTo(Client::class, 'owner');
    }
}
