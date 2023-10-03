<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'services_type_id',
        'name'
    ];
 
    protected $table = 'services';

    public function service_type()
    {
        return $this->belongsTo(ServiceType::class, 'services_type_id');
    }

    use HasFactory;
}
