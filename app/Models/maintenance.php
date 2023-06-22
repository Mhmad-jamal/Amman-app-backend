<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = 'maintenance';

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
