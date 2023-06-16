<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeProperty extends Model
{
    use HasFactory;

    protected $table = 'like_property';

    // Define the fillable columns
    protected $fillable = [
        'client_id',
        'property_id',
        // Add other fillable columns if needed
    ];

    // Define the relationships with other models if needed
}
