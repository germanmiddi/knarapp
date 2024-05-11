<?php

namespace App\Http\Controllers\Manager\RequestServicesItem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Events\RequestServiceItemCreated;

use App\Models\RequestServicesItem;
use App\Models\RequestService;

class RequestServicesItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Your code here
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Your code here
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::BeginTransaction();
        try{

            $item = new RequestServicesItem();
                $item->requests_id = $request->request_id;
                $item->request_service_id = $request->request_service_id;
                $item->item_type = 'extra';
                $item->description = $request->description;
                $item->price = $request->price;
            $item->save();
            
            RequestServiceItemCreated::dispatch($item);

            $total = RequestService::find($request->request_service_id);

            DB::commit();
            return response()->json(
                                ['message' => 'Item created successfully', 
                                 'total' => $total->total ], 200);

        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
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
        // Your code here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Your code here
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Your code here
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::BeginTransaction();
        try{
            $item = RequestServicesItem::find($id);
            $requestServiceId = $item->request_service_id;
            $item->delete();

            $total = RequestService::find($requestServiceId);

            DB::commit();
            return response()->json(
                                ['message' => 'Item deleted successfully', 
                                 'total' => $total->total ], 200);

        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}