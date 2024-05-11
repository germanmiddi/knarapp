<?php

namespace App\Http\Controllers\Manager\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;
use App\Models\Service;
use App\Models\RequestService;

// use App\Models\Address;
// use App\Models\Company;
// use App\Models\State;
// use App\Models\City;
// use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Facades\DB;


class ServiceController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return  Inertia::render('Manager/Services/List',
        [
            'toast' => Session::get('toast')
        ]);
    }

    public function edit(RequestService $service){

        $service->load('request', 
                       'request.client', 
                       'requestServicesItems', 
                       'servicepricelist', 
                       'serviceType', 
                       'status',
                       'from',
                       'to',
                       'driver' 
                    );

        return Inertia::render('Manager/Services/Edit', [
            'requestService' => $service
        ]);
    }

    public function create(){

        return Inertia::render('Manager/Services/Create');
    }

    public function list(){
        
        $services = RequestService::with('request','request.client',
                                        'creator',
                                        'servicepricelist',
                                        'driver',
                                        'status',
                                        'from',
                                        'to')->get();

        return $services;

    }
    public function confirmService(Service $service){

        $service->status_id = 2;
        $service->save();

        return response()->json(['message' => 'Servicio confirmado'], 200);
    }
}