<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Client;
use App\Model\RequestStatus;
use App\Model\User;
use App\Model\Service;
use App\Model\RequestService;


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
        return $this->belongTo(Client::class, 'client_id');
    }

    public function status()
    {
        return $this->belongTo(RequestStatus::class, 'status_id' );
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }    
    
    public function requestServices()
    {
        return $this->hasMany(RequestService::class, 'request_id');
    }    
    
    use HasFactory;
}
