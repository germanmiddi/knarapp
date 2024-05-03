<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([
        //     CuitexportsTableSeeder::class,
        //     CountrycodeSeeder::class

        // ]);

        User::create([
            'name' => 'German Middi',
            'email' => 'g@gmail.com',
            'password' => bcrypt('Inicio123')
        ]);
        
        DB::table('client_types')->insert([
            'name' => 'agencia',
            'created_at' => Carbon::now(),
        ]);

        DB::table('client_types')->insert([
            'name' => 'particular',
            'created_at' => Carbon::now(),
        ]);

        //Entradas en tabla services_types
        DB::table('services_type')->insert([
            'description' => 'Transfer',
            'created_at' => Carbon::now(),
        ]);
        
        DB::table('services_type')->insert([
            'description' => 'Transfer VAN',
            'created_at' => Carbon::now(),
        ]);

        DB::table('services_type')->insert([
            'description' => 'Transfer COMBI',
            'created_at' => Carbon::now(),
        ]);
        
        DB::table('services_type')->insert([
            'description' => 'Transfer MINIBUS',
            'created_at' => Carbon::now(),
        ]);

        DB::table('services_type')->insert([
            'description' => 'Excursión',
            'created_at' => Carbon::now(),
        ]);
        DB::table('driver_types')->insert([
            'name' => 'individual',
            'created_at' => Carbon::now(),
        ]);
        DB::table('driver_types')->insert([
            'name' => 'agencia',
            'created_at' => Carbon::now(),
        ]);

        DB::table('request_status')->insert([
            'name' => 'pendiente',
            'created_at' => Carbon::now(),
        ]);

        DB::table('request_status')->insert([
            'name' => 'confirmado',
            'created_at' => Carbon::now(),
        ]);
        DB::table('request_status')->insert([
            'name' => 'iniciado',
            'created_at' => Carbon::now(),
        ]);
        
        DB::table('request_status')->insert([
            'name' => 'finalizado',
            'created_at' => Carbon::now(),
        ]);

        DB::table('request_status')->insert([
            'name' => 'cancelado',
            'created_at' => Carbon::now(),
        ]);

        DB::table('request_services_status')->insert([
            'name' => 'pendiente',
            'created_at' => Carbon::now(),
        ]);

        DB::table('request_services_status')->insert([
            'name' => 'confirmado',
            'created_at' => Carbon::now(),
        ]);

        DB::table('request_services_status')->insert([
            'name' => 'en viaje',
            'created_at' => Carbon::now(),
        ]);
        
        DB::table('request_services_status')->insert([
            'name' => 'finalizado',
            'created_at' => Carbon::now(),
        ]);

        DB::table('request_services_status')->insert([
            'name' => 'cancelado',
            'created_at' => Carbon::now(),
        ]);

        $this->call([
            LocationSeeder::class,
            RoleSeeder::class,
        ]); 

    }
}
