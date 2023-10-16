<?php

namespace App\Http\Controllers\Manager\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Client;
use App\Models\Servicepricelist;
use App\Models\Location;
use App\Models\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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

    public function edit(Requests $request)
    {
        
        return  Inertia::render('Manager/Requests/Edit',[
                                    'clients'=> Client::all(),
                                    'services'=> Servicepricelist::all(),
                                    'locations' => Location::all(),
                                    'request' => $request,
                                ]);
        
    }

    public function store(Request $request)
    {
        
        DB::beginTransaction();

        try{

            $requests = new Requests;
            $requests->client_id   = $request->client_id;
            $requests->responsible = $request->responsible;
            // $requests->company = $request->company;
            $requests->observations = $request->observation;
            $requests->status_id    = 1; //$request->status;
            $requests->created_by   = Auth::user()->id;
            $requests->save();

            DB::commit();
            return response()->json(['message' => 'request generado'], 200);
            // return redirect()->route('request')->with('success', 'Request created successfully.');

        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 203);
        }
    }
}
