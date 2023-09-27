<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverServicesPrice extends Model
{
    protected $table = 'drivers_services_price';

    protected $fillable = [
        'driver_id',
        'servicepricelistsbase_id',
        'price',
        'active'

    ];
 
    protected $casts = [
        'active'  => 'boolean'
    ];   

    public function service()
    {
        return $this->belongsTo(Servicepricelistbase::class, 'servicepricelistsbase_id');
    }

    use HasFactory;
}
