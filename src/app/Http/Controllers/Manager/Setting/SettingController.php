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
    
        $result = ServiceType::all();
     
        return response()->json(['data'=> $result],200);

    }

    public function services_list(){
    
        $result = Service::with('service_type')->get();
     
     
        return response()->json(['data'=> $result],200);

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
            return response()->json(['data'=> $result],200);

        }catch( \Exception $e){
            DB::rollback();
            return response()->json(['error' => $e ],200);
        }
        
    }
    
}
