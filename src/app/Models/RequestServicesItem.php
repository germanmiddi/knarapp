<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestServicesItem extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla si no sigue la convención de Laravel
    protected $table = 'request_services_items';

    protected $fillable = [
        'requests_id',
        'request_service_id',
        'item_type',
        'description',
        'price',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    // Define las relaciones del modelo
    public function requests()
    {
        return $this->belongsTo(Requests::class, 'requests_id');
    }

    public function requestService()
    {
        return $this->belongsTo(RequestService::class, 'request_service_id');
    }
}
