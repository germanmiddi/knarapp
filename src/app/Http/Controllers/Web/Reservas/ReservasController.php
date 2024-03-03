<?php
namespace App\Http\Controllers\Web\Reservas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReservasController extends Controller
{
    public function index()
    {
        return  Inertia::render('Web/Reservas/Index');
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