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
        Schema::table('servicepricelists', function (Blueprint $table) {

            // Agregar columna pricelist_id y establecer la relación
            $table->unsignedBigInteger('servicepricelistsbase_id')->after('client_id' );
            $table->foreign('servicepricelistsbase_id')->references('id')->on('servicepricelistsbase');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servicepricelists', function (Blueprint $table) {
            //
        });
    }
};
