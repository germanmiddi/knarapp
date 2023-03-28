<?php

namespace App\Http\Controllers\Manager\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
// use App\Models\Client;
use Illuminate\Support\Facades\Session;

// use App\Models\Address;
// use App\Models\Company;
// use App\Models\State;
// use App\Models\City;
// use App\Models\Order;
// use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return  Inertia::render('Manager/Orders/List',
        [
            'toast' => Session::get('toast')
        ]);
    }


}