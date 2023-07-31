<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    public function run()
    {
        $locations = [
            // Hoteles
            [
                'type' => 'Hotel',
                'name' => 'Hotel Alvear Palace',
                'address' => 'Av. Alvear 1891',
                'city' => 'Buenos Aires',
                'state' => 'Ciudad Autónoma de Buenos Aires',
                'zip' => '1129',
            ],
            [
                'type' => 'Hotel',
                'name' => 'Faena Hotel Buenos Aires',
                'address' => 'Martha Salotti 445',
                'city' => 'Buenos Aires',
                'state' => 'Ciudad Autónoma de Buenos Aires',
                'zip' => '1107',
            ],
            // Agrega más hoteles aquí...
            [
                'type' => 'Hotel',
                'name' => 'Hotel Madero',
                'address' => 'Rosario Vera Peñaloza 360',
                'city' => 'Buenos Aires',
                'state' => 'Ciudad Autónoma de Buenos Aires',
                'zip' => '1107',
            ],
        [
            'type' => 'Hotel',
            'name' => 'Alvear Art Hotel',
            'address' => 'Suipacha 1036',
            'city' => 'Buenos Aires',
            'state' => 'Ciudad Autónoma de Buenos Aires',
            'zip' => '1008',
        ],
        [
            'type' => 'Hotel',
            'name' => 'Four Seasons Hotel Buenos Aires',
            'address' => 'Posadas 1086/88',
            'city' => 'Buenos Aires',
            'state' => 'Ciudad Autónoma de Buenos Aires',
            'zip' => '1011',
        ],
        [
            'type' => 'Hotel',
            'name' => 'Park Tower, a Luxury Collection Hotel',
            'address' => 'Avenida Leandro N. Alem 1193',
            'city' => 'Buenos Aires',
            'state' => 'Ciudad Autónoma de Buenos Aires',
            'zip' => '1001',
        ],
        [
            'type' => 'Hotel',
            'name' => 'Sheraton Buenos Aires Hotel & Convention Center',
            'address' => 'San Martín 1225/1275',
            'city' => 'Buenos Aires',
            'state' => 'Ciudad Autónoma de Buenos Aires',
            'zip' => '1104',
        ],
        [
            'type' => 'Hotel',
            'name' => 'Hilton Buenos Aires',
            'address' => 'Av. Macacha Güemes 351',
            'city' => 'Buenos Aires',
            'state' => 'Ciudad Autónoma de Buenos Aires',
            'zip' => '1106',
        ],
        [
            'type' => 'Hotel',
            'name' => 'Hotel Pulitzer Buenos Aires',
            'address' => 'Maipú 907',
            'city' => 'Buenos Aires',
            'state' => 'Ciudad Autónoma de Buenos Aires',
            'zip' => '1006',
        ],
        [
            'type' => 'Hotel',
            'name' => 'InterContinental Buenos Aires',
            'address' => 'Moreno 809',
            'city' => 'Buenos Aires',
            'state' => 'Ciudad Autónoma de Buenos Aires',
            'zip' => '1091',
        ],


            // Aeropuertos
            [
                'type' => 'Aeropuerto',
                'name' => 'Aeropuerto Internacional Ministro Pistarini (Ezeiza)',
                'address' => 'Autopista Tte. Gral. Ricchieri Km 33.5',
                'city' => 'Ezeiza',
                'state' => 'Buenos Aires',
                'zip' => '1802',
            ],
            [
                'type' => 'Aeropuerto',
                'name' => 'Aeroparque Jorge Newbery',
                'address' => 'Av. Costanera Rafael Obligado s/n',
                'city' => 'Ciudad Autónoma de Buenos Aires',
                'state' => 'Buenos Aires',
                'zip' => '1425',
            ],
            // Agrega más aeropuertos aquí...
        ];

        
            Location::insert($locations);
        
    }
}

