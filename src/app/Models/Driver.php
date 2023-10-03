<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{   
    use SoftDeletes;

    protected $fillable = [
        'name',
        'lastname',
        'email',
        'phone',
        'address',
        'user_id',
        'vehicle',
        'driver_types_id'
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function request_services()
    {
        return $this->hasMany(RequestService::class, 'driver_id');
    }

    public function types()
    {
        return $this->belongsTo(Drivertype::class, 'driver_types_id');
    }
}