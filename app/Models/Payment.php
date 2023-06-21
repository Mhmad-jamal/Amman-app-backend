<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['owner_id', 'client_id', 'contract_id', 'date', 'amount'];

    public function owner()
    {
        return $this->belongsTo(Client::class, 'owner_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
}
