<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    public function run()
    {

        $services = [
            [
                'services_type_id' => 1,
                'name' => 'Transfer Ezeiza / Hotel Céntrico o Viceversa',
            ],
            [
                'services_type_id' => 1,
                'name' => 'Transfer Ezeiza / Palermo o Viceversa',
            ],
            [
                'services_type_id' => 1,
                'name' => 'Transfer Buquebus / Hotel o Viceversa',
            ],
            [
                'services_type_id' => 1,
                'name' => 'Transfer Terminal Bus Retiro / Hotel o Viceversa',
            ],
            [
                'services_type_id' => 2,
                'name' => 'Transfer Ezeiza / Hotel Céntrico o Viceversa',
            ],
            [
                'services_type_id' => 2,
                'name' => 'Transfer Ezeiza / Palermo o Viceversa',
            ],
            [
                'services_type_id' => 2,
                'name' => 'Transfer Buquebus / Hotel o Viceversa',
            ],
            [
                'services_type_id' => 2,
                'name' => 'Transfer Terminal Bus Retiro / Hotel o Viceversa',
            ],
            [
                'services_type_id' => 3,
                'name' => 'Transfer Ezeiza / Hotel Céntrico o Viceversa',
            ],
            [
                'services_type_id' => 3,
                'name' => 'Transfer Ezeiza / Palermo o Viceversa',
            ],
            [
                'services_type_id' => 3,
                'name' => 'Transfer Buquebus / Hotel o Viceversa',
            ],
            [
                'services_type_id' => 3,
                'name' => 'Transfer Terminal Bus Retiro / Hotel o Viceversa',
            ]
        ];

        foreach ($services as $service) {
            \App\Models\Service::create($service);
        }

        $servicepricelistbase = [
            [
                'services_id' => 1,
                'wait_time' => 1,
                'baggage' => 0,
                'guide' => 0,
                'passenger_capacity' => 4,
                'duration' => 0,
                'price' => 50,
                'cost' => 40,
                'active' => 1,
            ],
            [
                'services_id' => 1,
                'wait_time' => 1,
                'baggage' => 0,
                'guide' => 0,
                'passenger_capacity' => 7,
                'duration' => 0,
                'price' => 90,
                'cost' => 40,
                'active' => 1,
            ],
            [
                'services_id' => 1,
                'wait_time' => 1,
                'baggage' => 0,
                'guide' => 0,
                'passenger_capacity' => 4,
                'duration' => 0,
                'price' => 50,
                'cost' => 40,
                'active' => 1,
            ],
            [
                'services_id' => 1,
                'wait_time' => 1,
                'baggage' => 1,
                'guide' => 1,
                'passenger_capacity' => 3,
                'duration' => 0,
                'price' => 50,
                'cost' => 40,
                'active' => 1,
            ],
        ];

        foreach ($servicepricelistbase as $servicepricelistbase) {
            \App\Models\Servicepricelistbase::create($servicepricelistbase);
        }
        
    }
}

