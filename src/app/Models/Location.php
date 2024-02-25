<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        "type",
        "name",
        "address",
        "city",
        "state",
        "zip",
        "lat",
        "lng"
    ];
    
    use HasFactory;
}
