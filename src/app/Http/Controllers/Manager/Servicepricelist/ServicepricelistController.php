<?php

namespace App\Http\Controllers\Manager\Servicepricelist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicepricelist;


class ServicepricelistController extends Controller
{
    //

    public function filter()
    {
        $result = Servicepricelist::query()
                                  ->where('client_id', '=', request('client_id'));
        
        if( intval(request('pax')) > 0){
            $result->where('passenger_capacity','>=', intval(request('pax')));
        }

        if(request('guia') != null){
            $result->where('guide', request('guia'));
        }

        if(request('equipaje') != null){
            $result->where('baggage', request('equipaje'));
        }

        // if(request('guia') == true){
        //     $result->where('guide', true);
        // }elseif(request('guia') == false){
        //     $result->where('guide', false);
        // }

        // if(request('equipaje') == true){
        //     $result->where('baggage', true);
        // }elseif(request('equipaje') == false){
        //     $result->where('baggage', false);
        // }

        $result->groupBy('detail', 'guide', 'baggage');

        return $result->get(); 

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
