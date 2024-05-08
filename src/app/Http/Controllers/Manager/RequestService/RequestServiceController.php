<?php

namespace App\Http\Controllers\Manager\RequestService;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

use App\Models\RequestService;
use App\Models\RequestServicesStatus;

class RequestServiceController extends Controller
{
    public function confirm(Request $request){

        // dd($request->all());

        DB::beginTransaction();

        try{
            $requestServiceStatus = 'confirmado';
            $requestServiceId = RequestServicesStatus::where('name', $requestServiceStatus)->value('id');
            if ($requestServiceId) {
                $requestService = RequestService::find($request->id);
                $requestService->update($request->all());
                $requestService->status_id = $requestServiceId;
                $requestService->save();
                DB::commit();
                return response()->json(['message' => 'Servicio confirmado'], 200);
            }
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function cancel(RequestService $requestService){

        DB::beginTransaction();

        try{
            $requestServiceStatus = 'cancelado';
            $requestServiceId = RequestServicesStatus::where('name', $requestServiceStatus)->value('id');
            if ($requestServiceId) {
                $requestService->status_id = $requestServiceId;
                $requestService->save();
                DB::commit();
                return response()->json(['message' => 'Servicio cancelado'], 200);
            }
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
