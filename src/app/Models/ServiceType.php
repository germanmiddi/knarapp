<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
 
    protected $table = 'services_type';


    use HasFactory;

    public function services()
    {
        return $this->hasMany(Service::class, 'services_type_id');
    }

    public function servicepricelistbase()
    {
        return $this->hasMany(Servicepricelistbase::class, 'services_type_id');
    }

    public function servicepricelist()
    {
        return $this->hasMany(Servicepricelist::class, 'service_type_id');
    }
    public function requestServices()
    {
        return $this->hasMany(RequestService::class, 'service_type_id');
    }
    
}
