<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table="contracts";
    protected $fillable = [
        'property_id',
        'owner_id',
        'client_name',
        'client_phone',
        'user_national_number',
        'start_date',
        'end_date',
        'clause',
        'discount',
        'price',
        'due_dates',
        'image',
        'status',
    ];
    


    // Define the relationships here (if any)
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function owner()
    {
        return $this->belongsTo(Client::class, 'owner_id');
    }
}
