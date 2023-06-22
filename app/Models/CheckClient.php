<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckClient extends Model
{
    use HasFactory;

    protected $table = 'check_client';

    protected $fillable = [
        'check_status',
        'nationalty_number',
        'owner_id',
    ];

    // Define the relationships with other models if needed
    public function owner()
    {
        return $this->belongsTo(Client::class, 'owner_id', 'id');
    }
    
    public function nationaltyOwner()
    {
        return $this->belongsTo(Client::class, 'nationalty_number', 'nationalty_number');
    }
}
