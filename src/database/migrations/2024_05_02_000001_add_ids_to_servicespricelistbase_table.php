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
        Schema::table('servicepricelistsbase', function (Blueprint $table) {
           
            $table->foreignId('services_type_id')->constrained('services_type');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servicepricelistsbase', function (Blueprint $table) {
            // Remover la columna service_type_id
            $table->dropConstrainedForeignId('service_type_id');

           
        });
    }
};
