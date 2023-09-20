<?php

namespace App\Http\Controllers\Manager\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Driver;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;



class DriverController extends Controller
{

    public function index(){

        return Inertia::render('Manager/Drivers/List',
        [
            'toast' => Session::get('toast')
        ]);
    }

    public function list(){


    }

    public function create(){



        return Inertia::render('Manager/Drivers/Create',
        [
            'toast' => Session::get('toast')
        ]);
    }

    public function store(){}

    public function edit(){


    }

    public function update(){}



}