<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

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

        //Entradas en tabla services_types
        \DB::table('services_type')->insert([
            'description' => 'Transfer',
            'created_at' => Carbon::now(),
        ]);
        \DB::table('services_type')->insert([
            'description' => 'Transfer VAN',
            'created_at' => Carbon::now(),
        ]);
        \DB::table('services_type')->insert([
            'description' => 'Transfer COMBI',
            'created_at' => Carbon::now(),
        ]);
        \DB::table('services_type')->insert([
            'description' => 'Transfer MINIBUS',
            'created_at' => Carbon::now(),
        ]);

        \DB::table('services_type')->insert([
            'description' => 'Excursión',
            'created_at' => Carbon::now(),
        ]);

        

    }
}
