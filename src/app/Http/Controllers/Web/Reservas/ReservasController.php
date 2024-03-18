<?php
namespace App\Http\Controllers\Web\Reservas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Location;
use App\Models\Servicepricelist;
use App\Models\User;

class ReservasController extends Controller
{
    public function index()
    {
        if (!auth()->user()->hasRole('CLIENT')
            && !auth()->user()->hasRole('ADMIN') ){
            abort(403, 'Unauthorized');
        }
    
        $list = Servicepricelist::where('client_id', auth()->user()->id)
                                ->active()
                                ->with('service', 'service.services', 'service.services.service_type')
                                ->get();

        // Preparar servicepricelist para pasar a la vista
        $servicepricelist = $list; // En este caso, ya tienes la lista, así que solo la asignamos directamente.

        // Extraer service_types con id y description
        $serviceTypes = $list->pluck('service.services.service_type.description', 'service.services.service_type.id')->unique()->toArray();

        $list_array = $list->toArray();

        // Extraer con un map service_types con id y description
        $serviceTypes = array_map(function($item){
            $return['id'] = $item['service']['services']['service_type']['id'];
            $return['description'] = $item['service']['services']['service_type']['description'];
            return $return;
        }, $list_array);

        $serviceTypes = array_unique($serviceTypes, SORT_REGULAR);

        return Inertia::render('Web/Reservas/Index', [
                                    'locations' => Location::all(),
                                    'servicepricelist' => $servicepricelist,
                                    'service_types' => $serviceTypes,
                                ]);
    }

    // public function create()
    // {
    //     return  Inertia::render('Web/Reservas/Create');
    // }

    // public function list()
    // {
    //     $reservas = Reservas::with('client','status','creator','requestServices')
    //                         ->get();
    //     return $reservas;
    // }

    // public function edit(Request $request)
    // {
    //     return  Inertia::render('Web/Reservas/Edit',[
    //                                 'clients'=> Client::all(),
    //                                 'services'=> Servicepricelist::all(),
    //                                 'locations' => Location::all(),
    //                                 'request' => $request,
    //                             ]);
    // }

    // public function store(Request $request)
    // {
    //     // dd( $request->all() );
    // }
}