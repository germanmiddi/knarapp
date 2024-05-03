<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servicepricelistbase extends Model
{
    protected $table = 'servicepricelistsbase';

    protected $fillable = [
        'services_id',
        'wait_time',
        'baggage',
        'guide',
        'passenger_capacity',
        'duration',
        'price',
        'cost',
        'active',
        'services_type_id',
    ];
    
    protected $casts = [
        'baggage' => 'boolean',
        'guide'   => 'boolean',
        'active'  => 'boolean'
    ];    

    public function services()
    {
        return $this->belongsTo(Service::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function drivers()
    {
        return $this->hasMany(DriverServicesPrice::class, 'servicepricelistsbase_id');
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class, 'services_type_id');
    }
    
    use HasFactory, SoftDeletes;
}
