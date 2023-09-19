<?php

namespace App\Http\Controllers\Manager\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;
use App\Models\Service;


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

    public function edit(Service $service){

        return Inertia::render('Manager/Services/Edit');
        

    }

}