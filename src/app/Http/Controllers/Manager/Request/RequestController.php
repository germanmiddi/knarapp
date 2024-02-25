<?php

namespace App\Http\Controllers\Manager\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Client;
use App\Models\Servicepricelist;
use App\Models\Location;
use App\Models\Requests;
use App\Models\RequestService;

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
        $requests = Requests::with('client','status','creator','requestServices')
                            ->get();
        return $requests;
    }

    public function edit(Request $request)
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

        // dd( $request->all() );

        DB::beginTransaction();

        try{

            $requests = new Requests;
            $requests->client_id   = $request->client_id;
            $requests->responsible = $request->responsible;
            // $requests->company = $request->company;
            $requests->observations = $request->observations;
            $requests->status_id    = 1; //$request->status;
            $requests->created_by   = Auth::user()->id;
            $requests->save();

            foreach($request->services as $service){
            
                $location_from = $service['location_from']['id'] == null ? 
                                Location::create(['name'=> $service['location_from']['name']])->id : $service['location_from']['id'];

                $location_to = $service['location_to']['id'] == null ? 
                                Location::create(['name'=> $service['location_to']['name']])->id : $service['location_to']['id'];                

                // dd($service['time']);
                $requestService = new RequestService();
                $requestService->requests_id = $requests->id;
                $requestService->servicepricelists_id = $service['service']['servicepricelists_id'];
                $requestService->location_from = $location_from;
                $requestService->location_to   = $location_to;
                $requestService->date = $service['date'];
                $requestService->time = $service['time'];
                $requestService->status_id = 1;
                $requestService->created_by = Auth::user()->id;
                $requestService->pax_cant = $service['pax_cant'];
                $requestService->pax_name = $service['pax_name'];
                $requestService->pax_mail = $service['pax_mail'];
                $requestService->pax_phone = $service['pax_phone'];
                $requestService->save();
            }


            DB::commit();
            return response()->json(['message' => 'request generado'], 200);
            // return redirect()->route('request')->with('success', 'Request created successfully.');

        }catch(\Exception $e){
            dd($e);
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 203);
        }
    }
}
