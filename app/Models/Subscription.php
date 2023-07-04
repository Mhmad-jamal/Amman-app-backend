<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'client_id',
        'start_date',
        'end_date',
        'payment_amount',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
