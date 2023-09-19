<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [


    ];
 
    protected $table = 'request_services';

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }    

    use HasFactory;
}
