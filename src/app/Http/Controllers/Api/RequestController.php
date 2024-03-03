<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function getOrders(Request $request){

        $services = [
            [
                'id' => 1,
                'service_type' => 'Transfer',
                'service_name' => 'Transfer Aeropuesto BCN / Hotel City',
                'company' => '',
                'cant_pax' => '3',
                'pax_contact' => [
                    'name' => 'John Doe',
                    'phone' => '+5555555555',
                    'email' => 'john.doe@gmail.com'    
                ],
                'date' => '01/10/2023',
                'time' => '09:00',
                'location_from' => [
                    'name' => 'Aeropuerto Josep Tarradellas',
                    'lat' =>  41.301908, 
                    'lng' => 2.072612
                ],
                'location_to' => [
                    'name' => 'Holiday Inn Express Barcelona',
                    'lat' => 41.40203324311969, 
                    'lng' => 2.198810284486863
                ],
                'status' => 'pending',
                'flight_number' => 'AA 1234'
            ],
            [
                'id' => 2,
                'service_type' => 'Transfer',
                'service_name' => 'Transfer Ezeiza / Hotel Céntrico o Viceversa',
                'company' => '',
                'cant_pax' => '3',
                'pax_contact' => [
                    'name' => '',
                    'phone' => '',
                    'email' => ''
                ],
                'date' => '15/10/2023',
                'time' => '20:00',
                'location_from' => [
                    'name' => 'Hotel Panamericano',
                    'lat' => -34.609964,
                    'lng' => -58.375181
                ],
                'location_to' => [
                    'name' => 'Aeropuerto Eziza',
                    'lat' => -34.822222,
                    'lng' => -58.535833
                ],
                'status' => 'pending',
                'flight_number' => '',
                'passengers' => 1
            ],
            [
                'id' => 3,
                'service_type' => 'Transfer',
                'service_name' => 'Transfer Ezeiza / Hotel Céntrico o Viceversa',
                'company' => '',
                'cant_pax' => '3',
                'pax_contact' => [
                    'name' => '',
                    'phone' => '',
                    'email' => ''
                ],
                'date' => '15/10/2023',
                'time' => '20:00',
                'location_from' => [
                    'name' => 'Hotel Panamericano',
                    'lat' => -34.609964,
                    'lng' => -58.375181
                ],
                'location_to' => [
                    'name' => 'Aeropuerto Eziza',
                    'lat' => -34.822222,
                    'lng' => -58.535833
                ],
                'status' => 'pending',
                'flight_number' => '',
                'passengers' => 1
            ]
        ];

                                        


        return response()->json([

            'services' => $services,

        ],200);
    
    }

}


