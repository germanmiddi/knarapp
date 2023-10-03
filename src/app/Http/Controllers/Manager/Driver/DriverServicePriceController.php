<?php

namespace App\Http\Controllers\Manager\Driver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

use App\Models\DriverServicesPrice;


class DriverServicePriceController extends Controller{
    

    public function store(Request $request){

        // dd($request->all());

        DB::beginTransaction();
        try{
            $driverServicesPrice = new DriverServicesPrice();
            $driverServicesPrice->driver_id = $request->driver_id;
            $driverServicesPrice->servicepricelistsbase_id = $request->service['id'];
            $driverServicesPrice->price = $request->cost;
            $driverServicesPrice->active = true;
            $driverServicesPrice->save();

            DB::commit();
            return response()->json(['message'   => 'Servicio creado correctamente',
                                     'id'        => $driverServicesPrice->id, 
                                     'driver_id' => $driverServicesPrice->driver_id,
                                     'servicepricelistsbase_id' => $driverServicesPrice->servicepricelistsbase_id,
                                     'price'     => $driverServicesPrice->price,
                                     'active'    => $driverServicesPrice->active], 200);
        }catch(\Exception $e){
            DB::rollback();
            $error = $e->getMessage();
            return response()->json(['message' => $error], 404);
        }

    }

    public function toggleActive(Request $request){
        
        DB::beginTransaction();
        try{
            $driverServicesPrice = DriverServicesPrice::find($request->id);
            if ($driverServicesPrice->price <= 0) {
                throw new \Exception('El precio debe ser mayor a 0 ' . $driverServicesPrice->price);
            }
            $driverServicesPrice->active = !$driverServicesPrice->active;
            $driverServicesPrice->save();
            DB::commit();
            return response()->json(['message' => 'Servicio activado correctamente',
                                     'dsp_id' => $driverServicesPrice->id,
                                     'dsp_active' => $driverServicesPrice->active ], 200);

        }catch(\Exception $e){
            DB::rollback();
            $error = $e->getMessage();
            return response()->json(['message' => $error], 404);

        }

    }

 

}