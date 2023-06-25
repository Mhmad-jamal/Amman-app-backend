<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table='users';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'gender',
        'address',
        'number',
        'city',
        'ZIP',
    ];
    protected $guarded = ['id', 'created_at', 'updated_at'];

}
