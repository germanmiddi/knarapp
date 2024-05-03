<?php

namespace App\Http\Controllers\Manager\Servicepricelist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicepricelist;

use Illuminate\Support\Facades\DB;


class ServicepricelistController extends Controller
{
    //
    public function get_services_types_by_client(){
        
        $result = Servicepricelist::where('client_id', '=', request('client_id'))
                                    ->active()
                                    // ->with('service', 'service.services', 'service.services.service_type')
                                    ->with('servicetype')
                                    ->get();
        

        $serviceTypes = $result->pluck('servicetype.description', 'servicetype.id')->unique();

        return response()->json($serviceTypes, 200);
    }
    public function filter()
    {

        $result =  DB::table('servicepricelists')
                       ->select('servicepricelists.id as servicepricelists_id',
                                'servicepricelists.*', 
                                'servicepricelistsbase.*',
                                'services.*',
                                'services_type.*')
                       ->join('servicepricelistsbase', 'servicepricelistsbase.id', '=', 'servicepricelistsbase_id')
                       ->join('services', 'services.id', '=', 'servicepricelistsbase.services_id')
                       ->join('services_type', 'services_type.id', '=', 'services.services_type_id')
                       ->where('client_id', request('client_id'))
                       ->where('servicepricelists.active', true);

        if(request('service_type') != null){
            $result->where('services_type.id', request('service_type'));
        }
        
        if (intval(request('pax')) > 0) {
            $result->where('servicepricelistsbase.passenger_capacity', '>=', intval(request('pax')));
        }

        if (request('guia') != null) {
            $result->where('servicepricelistsbase.guide', request('guia'));
        }

        if (request('equipaje') != null) {
            $result->where('servicepricelistsbase.baggage', request('equipaje'));
        }

        return $result->get();
       
    }

    public function toggleActive(Request $request){
        
        DB::beginTransaction();
        try{
            $servicepricelist = Servicepricelist::find($request->id);
            if ($servicepricelist->price <= 0) {
                throw new \Exception('El precio debe ser mayor a 0 ' . $servicepricelist->price);
            }
            $servicepricelist->active = !$servicepricelist->active;
            $servicepricelist->save();

            if($servicepricelist->active){
                $msg = 'Servicio activado correctamente';
            }else{
                $msg = 'Servicio desactivado correctamente';
            }

            DB::commit();
            return response()->json(['message' => $msg,
                                     'csp_id' => $servicepricelist->id,
                                     'csp_active' => $servicepricelist->active ], 200);

        }catch(\Exception $e){
            DB::rollback();
            $error = $e->getMessage();
            return response()->json(['message' => $error], 404);

        }

    }    

    public function store(Request $request){

        DB::beginTransaction();
        try{

            if($request->service['csp_id']){
                $servicepricelist = Servicepricelist::find($request->service['csp_id']);
                $msg = "Servicio actualizado correctamente";
            }else{
                $servicepricelist = new Servicepricelist();
                $servicepricelist->client_id = $request->client_id;
                $servicepricelist->servicepricelistsbase_id = $request->service['id'];
                $servicepricelist->created_by = auth()->user()->id;
                $servicepricelist->active = true;
                $servicepricelist->services_id  = $request->service['services_id'];
                $servicepricelist->services_type_id = $request->service['services_type_id'];
                $msg = "Servicio creado correctamente"; 
            }

            $servicepricelist->price = $request->cost;
            $servicepricelist->save();

            DB::commit();
            return response()->json(['message'   => $msg, 
                                     'id'        => $servicepricelist->id, 
                                     'client_id' => $servicepricelist->client_id,
                                     'servicepricelistsbase_id' => $servicepricelist->servicepricelistsbase_id,
                                     'price'     => $servicepricelist->price,
                                     'active'    => $servicepricelist->active], 200);            

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $error = $e->getMessage();
            return response()->json(['message' => $error], 404);
        }
    }

    // public function index()
    // {
    //     return view('manager.servicepricelist.index');
    // }

    // public function create()
    // {
    //     return view('manager.servicepricelist.create');
    // }

    // public function store(Request $request)
    // {
    //     //
    // }

    // public function show($id)
    // {
    //     return view('manager.servicepricelist.show');
    // }

    // public function edit($id)
    // {
    //     return view('manager.servicepricelist.edit');
    // }

    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // public function destroy($id)
    // {
    //     //
    // }

    



}
