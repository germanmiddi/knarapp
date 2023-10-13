<?php

namespace App\Http\Controllers\Manager\Setting;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use \App\Models\ServiceType;
use \App\Models\Service;
use \App\Models\Servicepricelistbase;
use App\Models\DriverServicesPrice;
use App\Models\Servicepricelist;

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
        // $result = ServiceType::all();
        $result = ServiceType::has('services')->get();
        return response()->json(['data'=> $result],200);
    }

    public function service_type_list_all(){
        $result = ServiceType::all();
        return response()->json(['data'=> $result],200);
    }

    public function services_list(){
    
        $result = Service::with('service_type')->get();
     
     
        return response()->json(['data'=> $result],200);

    }

    public function services_store(Request $request){
        
        DB::beginTransaction();

        try{

            $service = new Service();
            $service->services_type_id = $request->tipo_servicio;
            $service->name = $request->name;
            $service->save();

            DB::commit();
            return response()->json(['message'   => 'Servicio creado correctamente'], 200);
        }catch(e){
            DB::rollback();
            return response()->json(['error' => $e->getMessage()     ],200);

        }
        

    }



    public function services_price_list_base_list(){
        
        $result = Servicepricelistbase::with(['services', 'services.service_type'])->get();

        return response()->json(['data'=> $result],200);
    
    }

    public function services_price_list_base_store(Request $request){
            
        try{
            // dd($request->all());
            DB::beginTransaction();

            $data = new Servicepricelistbase();
            $data->services_id  = $request->services_id;
            $data->wait_time    = $request->wait_time;
            $data->baggage      = $request->baggage;
            $data->guide        = $request->guide;
            $data->passenger_capacity  = $request->passenger_capacity;
            $data->duration     = $request->duration;
            $data->price        = $request->price;
            $data->cost         = $request->cost;
            $data->active       = true;
            $data->save();
    
            // $result = Servicepricelistbase::create($data);            
            DB::commit();
            return response()->json(['data'=> $data],200);

        }catch( \Exception $e){
            DB::rollback();
            return response()->json(['error' => $e ],200);
        }
        
    }
 
    public function services_price_list_base_update(Request $request){


        DB::beginTransaction();
        try{

            $data = Servicepricelistbase::find($request->id);
            $data->services_id  = $request->services_id;
            $data->wait_time    = $request->wait_time;
            $data->baggage      = $request->baggage;
            $data->guide        = $request->guide;
            $data->passenger_capacity  = $request->passenger_capacity;
            $data->duration     = $request->duration;
            $data->price        = $request->price;
            $data->cost         = $request->cost;
            $data->active       = $request->active;
            $data->save();

            DB::commit();
            return response()->json(['message'   => 'Servicio creado correctamente'], 200);

        }catch(\Exception $e){
            DB::rollback();
            $error = $e->getMessage();
            return response()->json(['message' => $error], 404);
        }


    }

    public function services_price_list_base_delete(Request $request){
        
        DB::beginTransaction();
        try{

            // Verificar si algún conductor tiene asignado este servicio
            $driversWithService = DriverServicesPrice::where('servicepricelistsbase_id', $request->id)->count();

            if ($driversWithService > 0) {
                DB::rollback();
                return response()->json(['message' => 'No se puede eliminar este servicio, ya está asignado a conductores'], 400);
            }
            $clientWithService = Servicepricelist::where('servicepricelistsbase_id', $request->id)->count();
            
            if ($clientWithService > 0) {
                DB::rollback();
                return response()->json(['message' => 'No se puede eliminar este servicio, ya está asignado a clientes'], 400);
            }

            $data = Servicepricelistbase::find($request->id);
            $data->delete();

            DB::commit();
            return response()->json(['message'   => 'Servicio creado correctamente'], 200);

        }catch(\Exception $e){
            DB::rollback();
            $error = $e->getMessage();
            return response()->json(['message' => $error], 404);
        }
    }
}
