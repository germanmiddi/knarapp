<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drivers_services_price', function (Blueprint $table) {
            // Agregar columna driver_id y establecer la relación
            $table->unsignedBigInteger('driver_id')->after('id' );
            $table->foreign('driver_id')->references('id')->on('drivers');

            // Agregar columna pricelist_id y establecer la relación
            $table->unsignedBigInteger('servicepricelistsbase_id')->after('driver_id' );
            $table->foreign('servicepricelistsbase_id')->references('id')->on('servicepricelistsbase');

            // Agregar columna price
            $table->float('price')->after('servicepricelistsbase_id');

            // Agregar columna active (boolean)
            $table->boolean('active')->after('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drivers_services_price', function (Blueprint $table) {
            //
        });
    }
};
