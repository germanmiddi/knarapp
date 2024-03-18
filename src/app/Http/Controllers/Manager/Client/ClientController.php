<?php

namespace App\Http\Controllers\Manager\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use App\Models\Client;
use App\Models\Servicepricelistbase;
use App\Models\Servicepricelist;
use App\Models\Requests;
use App\Models\User;
use App\Models\Role;

// use App\Models\Address;
// use App\Models\Company;
// use App\Models\State;
// use App\Models\City;
// use App\Models\Order;
// use Illuminate\Support\Facades\DB;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return  Inertia::render('Manager/Clients/List',
        [
            'toast' => Session::get('toast')
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return  Inertia::render('Manager/Clients/Create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $client = new Client;
            
            $client->company_name = $request->input('company_name');
            $client->client_type_id = $request->input('client_type_id');
            $client->fullname = $request->input('fullname');
            $client->email = $request->input('email');
            $client->phone = $request->input('phone');
            $client->cellphone = $request->input('cellphone');
            $client->cuit = $request->input('cuit');
            $client->billing_type = $request->input('billing_type');
            $client->address = $request->input('address');
            // $client->zipcode = $request->input('zipcode');
            $client->notes = $request->input('notes');
    
            $client->save();

            // Se genera el usuario para el chofer
            $user = new User();
            $user->name = $request->fullname;
            $user->email = $request->email;
            $user->password = bcrypt('12345678');
            $user->save();

            // Asumiendo que el rol "CLIENT" existe
            $role = Role::where('name', 'CLIENT')->first();
            // Asignar el rol
            $user->roles()->attach($role->id);

            // Copiar entradas de servicepricelistbase a servicepricelist
            $servicePriceListBaseItems = Servicepricelistbase::all();

            foreach ($servicePriceListBaseItems as $baseItem) {
                $servicePriceListItem = new Servicepricelist;

                // Asignar valores del baseItem al listItem
                $servicePriceListItem->client_id = $client->id;
                $servicePriceListItem->servicepricelistsbase_id = $baseItem->id;
                $servicePriceListItem->price = $baseItem->price;
                $servicePriceListItem->created_by = Auth::id();

                $servicePriceListItem->save();
            }


            DB::commit();
            return Redirect::route('client')->with(['toast' => ['message' => 'Cliente creado correctamente', 'status' => '200']]);
       
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return Redirect::route('client')->with(['toast' => ['message' => 'Se ha producido un error', 'status' => '203']]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {      

        $clientId = $client->id; // ID del cliente
        $serviceBase = Servicepricelistbase::with(['services', 'services.service_type'])
            ->leftJoin('servicepricelists', function ($join) use ($clientId) {
                $join->on('servicepricelistsbase.id', '=', 'servicepricelists.servicepricelistsbase_id')
                        ->where('servicepricelists.client_id', '=', $clientId);
            })
            ->selectRaw('servicepricelistsbase.*,
                         servicepricelists.id AS csp_id,
                         servicepricelists.client_id AS csp_client_id,
                         servicepricelists.price AS csp_price,
                         servicepricelists.active AS csp_active')  
            ->get();
                                                                    
        return  Inertia::render('Manager/Clients/Edit',[
            'client' => $client,
            // 'driverTypes' => Drivertype::all(),
            'serviceBase' => $serviceBase,
        ]);        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        DB::beginTransaction();
        try {
            Client::where('id', $request->id)->update([
                'company_name'   => $request->company_name,
                'client_type_id' => $request->client_type_id,
                'fullname'       => $request->fullname,
                'email'          => $request->email,
                'phone'          => $request->phone,
                'cellphone'      => $request->cellphone,
                'cuit'           => $request->cuit,
                'billing_type'   => $request->billing_type,
                'address'        => $request->address,
                'notes'          => $request->notes
            ]);     

            DB::commit();
            return Redirect::route('client')->with(['toast' => ['message' => 'Cliente actualizado correctamente', 'status' => '200']]);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['message' => 'Se ha producido un error', 'status' => '203']);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {        

        DB::beginTransaction();
        try{       
            $countRequests = Requests::where('client_id', $request->id)->count();
            if ($countRequests > 0) {
                return response()->json(['message' => 'No se puede eliminar el cliente porque tiene pedidos asociados', 'status' => '203']);
            } 
            
            Servicepricelist::where('client_id', $request->id)->forceDelete();
            Client::where('id', $request->id)->delete();
            DB::commit();
            return response()->json(['message' => 'Cliente eliminado correctamente', 'status' => '200']);

        }catch(\Throwable $th){
            DB::rollback();
            return response()->json(['message' => 'Se ha producido un error', 'status' => '203']);
        }

    }

    public function list(){

        return  Client::orderBy("created_at", 'DESC')
                        ->paginate(999)
                        ->withQueryString()
                        ->through(fn ($client) => [
                            'id'             => $client->id,
                            'company_name'   => $client->company_name,
                            'client_type_id' => $client->client_type_id,
                            'fullname'       => $client->fullname,
                            'email'          => $client->email,
                            'phone'          => $client->phone,
                            'cellphone'      => $client->cellphone,
                            'cuit'           => $client->cuit,
                            'billing_type'   => $client->billing_type,
                            'address'        => $client->address,
                            'zipcode'        => $client->zipcode,
                            'notes'          => $client->notes
                        ]);
    }

    public function getCityByCp(){
        return City::where('zipcode', request('cp'))->get();
    }

    public function getAllPriceList(){
        return Servicepricelist::all();
    }
}

