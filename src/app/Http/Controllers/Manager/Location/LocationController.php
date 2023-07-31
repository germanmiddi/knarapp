<?php

namespace App\Http\Controllers\Manager\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Location;

class LocationController extends Controller
{
    
    public function list(){
        return Location::all();
    }


}
