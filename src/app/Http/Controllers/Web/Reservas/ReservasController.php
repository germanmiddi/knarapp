<?php
namespace App\Http\Controllers\Web\Reservas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Location;
use App\Models\Servicepricelist;
use App\Models\User;
use App\Models\Requests;
use App\Models\RequestService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ReservasController extends Controller
{
    public function index()
    {
        if (!auth()->user()->hasRole('CLIENT')
            && !auth()->user()->hasRole('ADMIN') ){
            abort(403, 'Unauthorized');
        }
        
        if(!auth()->user()->hasRole('CLIENT') && 
            auth()->user()->client != null){
            abort(403, 'Su usuario no esta asociado a ningun cliente.');
        }
        


        // Si el usuario es admin, toma todos los registros; si es cliente, toma solo los de su cliente
        if (auth()->user()->hasRole('ADMIN')) {
            $list = Servicepricelist::active()
                                    ->with('servicetype')
                                    ->get();
        } else {
            $list = Servicepricelist::where('client_id', auth()->user()->client->id)
                                    ->active()
                                    ->join('services_type', 'services_type.id', '=', 'servicepricelists.services_type_id')
                                    ->select('servicepricelists.services_type_id', 'services_type.description')
                                    ->groupBy('servicepricelists.services_type_id')
                                    ->get();

        }
        
        $serviceTypes = $list->toArray();
        
        return Inertia::render('Web/Reservas/Index', [
                                    'locations' => Location::all(),
                                    'service_types' => $serviceTypes,
                                ]);
    }

    public function store(Request $request)
    {

        // dd( $request->all() );

        DB::beginTransaction();

        try{

            $requests = new Requests;
            $requests->client_id   = auth()->user()->client->id;//$request->client_id;
            // $requests->responsible = $request->responsible;
            // $requests->company = $request->company;
            // $requests->observations = $request->observations;
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
                $requestService->services_type_id = $service['selectedServiceType'];
                // $requestService->servicepricelists_id = 1; // $service['service']['servicepricelists_id'];
                $requestService->location_from = $location_from;
                $requestService->location_to   = $location_to;
                $requestService->date = $service['date'];
                $requestService->time = $service['time'];
                $requestService->status_id = 1;
                $requestService->created_by = Auth::user()->id;
                $requestService->pax_cant = $service['pax_cant'];
                $requestService->pax_name = $request->pax_name;
                $requestService->pax_mail = $request->pax_mail;
                // $requestService->pax_phone = $service['pax_phone'];
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


    // public function create()
    // {
    //     return  Inertia::render('Web/Reservas/Create');
    // }

    // public function list()
    // {
    //     $reservas = Reservas::with('client','status','creator','requestServices')
    //                         ->get();
    //     return $reservas;
    // }

    // public function edit(Request $request)
    // {
    //     return  Inertia::render('Web/Reservas/Edit',[
    //                                 'clients'=> Client::all(),
    //                                 'services'=> Servicepricelist::all(),
    //                                 'locations' => Location::all(),
    //                                 'request' => $request,
    //                             ]);
    // }

    // public function store(Request $request)
    // {
    //     // dd( $request->all() );
    // }
}