<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Client;
// use App\Models\RequestStatus;
// use App\Models\User;
// use App\Models\Service;
// use App\Models\RequestService;


class Requests extends Model
{
    protected $table = 'requests';

    protected $fillable = [
        'client_id',
        'responsible',
        'observations',
        'status_id',
        'created_by',
        'updated_by'
    ];
    
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function status()
    {
        return $this->belongsTo(RequestStatus::class, 'status_id' );
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }    
    
    public function requestServices()
    {
        return $this->hasMany(RequestService::class);
    }    
    
    use HasFactory;
}
