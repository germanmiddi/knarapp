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
}
