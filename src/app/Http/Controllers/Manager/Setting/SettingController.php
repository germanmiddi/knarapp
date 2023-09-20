<?php

namespace App\Http\Controllers\Manager\Setting;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use \App\Models\ServiceType;
use \App\Models\Service;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        return Inertia::render('Manager/Settings/Index');

    }

    public function service_type_list(){
    
        $result = ServiceType::all();
     
        return response()->json(['data'=> $result],200);

    }

    public function services_list(){
    
        $result = Service::with('service_type')->get();
     
     
        return response()->json(['data'=> $result],200);

    }
    
}
