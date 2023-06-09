<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'Order';

    protected $fillable = [
     
        'type',
        'name',
        'description',
        'image',
        'client_id',
        'status',

    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
