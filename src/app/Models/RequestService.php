<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestService extends Model
{
    protected $fillable = [
        'requests_id',
        'servicepricelists_id',
        'date',
        'time',
        'location_from',
        'location_to',
        'flight_number',
        'status_id',
        'driver_id',
        'created_by',
        'updated_by',
        'services_type_id',
        'guide_name'
    ];
 
    protected $casts = [
        'time'    => 'json',
        'baggage' => 'boolean',
        'guide'   => 'boolean'
    ];

    public function request()
    {
        return $this->belongsTo(Requests::class,'requests_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }    

    public function servicepricelist()
    {
        return $this->belongsTo(Servicepricelist::class, 'servicepricelists_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function status()
    {
        return $this->belongsTo(RequestServicesStatus::class, 'status_id');
    }

    public function from(){
        return $this->belongsTo(Location::class, 'location_from');
    }

    public function to(){
        return $this->belongsTo(Location::class, 'location_to');
    }

    public function serviceType(){
        return $this->belongsTo(ServiceType::class, 'services_type_id');
    }

    use HasFactory;
}
