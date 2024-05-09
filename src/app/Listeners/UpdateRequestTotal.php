<?php

namespace App\Listeners;

use App\Models\Requests;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\RequestService;
use App\Models\RequestServicesItem;

class UpdateRequestTotal
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // dd($event->item);
        DB::BeginTransaction();
        try{
            $service_id = $event->item->request_service_id;

            $items = RequestServicesItem::where('request_service_id', $service_id)->get();
    
            $total = 0;
            foreach($items as $item){
                $total += $item->price;
            }
    
            $service = RequestService::find($service_id);
            $service->total = $total;
            $service->save();

            $services = RequestService::where('requests_id', $service->requests_id)->get();
            
            $totalRequest = 0;
            foreach($services as $service){
                $totalRequest += $service->total;
            }

            $request = Requests::find($service->requests_id);
            $request->total = $totalRequest;
            $request->save();
            
            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
            Log::error("Error processing event: " . $e->getMessage());
        }

       



    }
}
