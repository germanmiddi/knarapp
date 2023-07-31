<?php

namespace App\Http\Controllers\Manager\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Client;
use App\Models\Servicepricelist;
use App\Models\Location;
use App\Models\Requests;


class RequestController extends Controller
{
    //

    public function index()
    {
        return  Inertia::render('Manager/Requests/List');
    }

    public function create()
    {
        //
        return  Inertia::render('Manager/Requests/Create',[
                                    'clients'=> Client::all(),
                                    'services'=> Servicepricelist::all(),
                                    'locations' => Location::all(),
                                ]);
        
    }

    public function list(){
        $requests = Requests::get();
        return $requests;
    }


}
