<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_name',
        'fullname',
        'email',
        'phone',
        'cellphone',
        'address',
        'zipcode',
        'cuit',
        'billing_type',
        'notes',
        'client_type_id',
    ];

    public function clientType()
    {
        return $this->belongsTo(ClientType::class, 'client_type_id');
    }

    public function servicePriceLists()
    {
        return $this->hasMany(ServicePriceList::class, 'client_id');
    }
    
    public function requests()
    {
        return $this->hasMany(Requests::class, 'client_id');
    }


}
