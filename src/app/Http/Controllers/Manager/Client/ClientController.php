<?php

namespace App\Http\Controllers\Manager\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

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
            $client->zipcode = $request->input('zipcode');
            $client->notes = $request->input('notes');



            // $client->fullname    = $request->input('fullname');
            // $client->dni         = $request->input('dni');
            // $client->email       = $request->input('email');
            // $client->phone       = $request->input('phone');
            // $client->cellphone   = $request->input('cellphone');
            // $client->client_type = $request->input('client_type');
            // $client->company_id  = $request->input('company_id');
            // $client->price       = $request->input('price') ?? 0;
            // $client->notes       = $request->input('notes');
    
            $client->save();

            // $adrc = new Address;
            // $adrc->client_id = $client->id;
            // $adrc->google_address = $request->input('google_address') ?? '';
            // $adrc->google_area1 = $request->input('google_area1');
            // $adrc->google_postal_code = $request->input('google_postal_code');
            // $adrc->google_latitude  = $request->input('google_latitude');
            // $adrc->google_longitude  = $request->input('google_longitude');
            // $adrc->notes = $request->input('notesAdrc');

            // $adrc->save();
            DB::commit();
            return Redirect::route('clients')->with(['toast' => ['message' => 'Cliente creado correctamente', 'status' => '200']]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return Redirect::route('clients')->with(['toast' => ['message' => 'Se ha producido un error', 'status' => '203']]);
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
        $client->load('servicePriceLists');    
        return  Inertia::render('Manager/Clients/Edit',[
            'cliente' => $client,
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
                'fullname'  => $request->fullname,
                'dni'       => $request->dni,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'cellphone' => $request->cellphone,
                'client_type' => $request->client_type,
                'company_id'  => $request->company_id,
                'price' => $request->price ?? 0,
                'notes' => $request->notes
            ]);     

            DB::commit();
            return Redirect::route('clients')->with(['toast' => ['message' => 'Cliente actualizado correctamente', 'status' => '200']]);
        } catch (\Throwable $th) {
            DB::rollback();
            return Redirect::route('clients')->with(['toast' => ['message' => 'Se ha producido un error', 'status' => '203']]);
        }
        
    }

    // public function update_dashboard(Request $request){

    //     DB::beginTransaction();
    //     try {
    //         Client::where('id', $request->id)->update([
    //             'cellphone' => $request->cellphone,
    //         ]);   
    //         DB::commit();
    //         return response()->json(['message'=>'Cliente actualizado correctamente','title'=>'Dashboard'], 200);
    //     }catch (\Throwable $th) {
    //         DB::rollback();
    //         return response()->json(['message'=>'Se ha producido un error','title'=>'Dashboard'], 203);
    //     }

    // }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
                            'notes'          => $client->notes,
                        ]);
    }

    public function getCityByCp(){
        return City::where('zipcode', request('cp'))->get();
    }

}

