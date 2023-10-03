<?php

namespace App\Http\Controllers\Manager\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Drivertype;
use App\Models\Driver;
use App\Models\DriverServicesPrice;
use App\Models\Service;
use App\Models\Servicepricelistbase;


class DriverController extends Controller
{

    public function index(){

        return Inertia::render('Manager/Drivers/List',
        [
            'toast' => Session::get('toast')
        ]);
    }

    public function list(){


        $length = request('length');
        $result = Driver::query();

        return  $result->paginate($length)->withQueryString()
                        ->through(fn ($driver) => [
                            'id'      => $driver->id,
                            'name'    => $driver->name,
                            'lastname' => $driver->lastname,
                            'email'   => $driver->email,
                            'phone'   => $driver->phone,
                            'address' => $driver->address,
                            'user_id' => $driver->user_id,
                            'vehicle' => $driver->vehicle,
                            'driver_type' => $driver->types()->first()->name,
                        ]);

    }

    public function create(){

        return Inertia::render('Manager/Drivers/Create',
        [
            'toast' => Session::get('toast'),
            'DriverTypes' => Drivertype::all(),
        ]);
    }

    public function store(Request $request){

        try{
            DB::beginTransaction();
            // Se genera el usuario para el chofer
            $user = new User();
            $user->name = $request->name . ' ' . $request->lastname;
            $user->email = $request->email;
            $user->password = bcrypt('12345678');
            $user->save();

            // Se genera el chofer
            $driver = new Driver();
            $driver->driver_types_id = $request->driver_types_id;
            $driver->name   = $request->name;
            $driver->lastname = $request->lastname;
            $driver->email   = $request->email;
            $driver->phone   = $request->cellphone;
            $driver->address = $request->address;
            $driver->user_id = $user->id;
            $driver->vehicle = $request->vehicle;
            $driver->save();

            // Se generan los precios de los servicios para el chofer
            $servicesBase = Servicepricelistbase::all();

            foreach ($servicesBase as $serviceBase) {
                $driverServicesPrice = new DriverServicesPrice();
                $driverServicesPrice->driver_id = $driver->id;
                $driverServicesPrice->servicepricelistsbase_id = $serviceBase->id;
                $driverServicesPrice->price = $serviceBase->cost;
                $driverServicesPrice->save();
            }

            DB::commit();
            return Redirect::route('drivers')->with(['toast' => ['message' => 'Chofer creado correctamente', 'status' => '200']]);
    
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return Redirect::route('drivers')->with(['toast' => ['message' => 'Se ha producido un error', 'status' => '203']]);
        }
    }

    public function edit(Driver $driver){

        $driverId = $driver->id; // Cambia esto al ID del conductor que deseas
        $serviceBase = Servicepricelistbase::with(['services', 'services.service_type'])
            ->leftJoin('drivers_services_price', function ($join) use ($driverId) {
                $join->on('servicepricelistsbase.id', '=', 'drivers_services_price.servicepricelistsbase_id')
                        ->where('drivers_services_price.driver_id', '=', $driverId);
            })
            ->selectRaw('servicepricelistsbase.*,
                         drivers_services_price.id AS dsp_id,
                         drivers_services_price.driver_id AS dsp_driver_id,
                         drivers_services_price.price AS dsp_price,
                         drivers_services_price.active AS dsp_active')  
            ->get();
                                                                    
        return  Inertia::render('Manager/Drivers/Edit',[
            'driver' => $driver,
            'driverTypes' => Drivertype::all(),
            'serviceBase' => $serviceBase,
        ]);

    }

    public function update(Request $request){

        DB::beginTransaction();
        try {
            $driver = Driver::find($request->id);
            $driver->driver_types_id = $request->driver_types_id;
            $driver->name   = $request->name;
            $driver->lastname = $request->lastname;
            $driver->email   = $request->email;
            $driver->phone   = $request->cellphone;
            $driver->address = $request->address;
            $driver->vehicle = $request->vehicle;
            $driver->save();

            DB::commit();
            return Redirect::route('drivers')->with(['toast' => ['message' => 'Chofer actualizado correctamente', 'status' => '200']]);
    
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return Redirect::route('drivers')->with(['toast' => ['message' => 'Se ha producido un error', 'status' => '203']]);
        }


    }



}