<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestService extends Model
{
    protected $fillable = [


    ];
 

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
