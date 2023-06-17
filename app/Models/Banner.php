<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banner'; // Replace with your actual table name

    protected $fillable = [
        'id',
        'image',
        // Add other fillable attributes here
    ];

    protected $casts = [
        'id' => 'integer',
        'image' => 'array',
    ];

    // Add any additional model configurations or relationships if needed
}
