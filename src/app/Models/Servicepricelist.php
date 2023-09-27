<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servicepricelist extends Model
{
    protected $fillable = [
        'client_id',
        'servicepricelistsbase_id',
        'price',
        'active',
        'created_by'
        
    ];
    
    protected $casts = [
        'active'  => 'boolean'
    ];    
    
    protected $dates = [
        'deleted_at',
        'price_valid_to'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function service()
    {
        return $this->belongsTo(Servicepricelistbase::class, 'servicepricelistsbase_id');
    }

    use HasFactory, SoftDeletes;
}
