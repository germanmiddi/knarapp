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
        Schema::table('request_services', function (Blueprint $table) {
            // Agregar la nueva columna service_type_id que es una clave foránea
            // $table->foreignId('service_type_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('services_type_id')->constrained('services_type');
            // Hacer opcional el campo servicepricelist_id
            $table->foreignId('servicepricelists_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('request_services', function (Blueprint $table) {
            // Remover la columna service_type_id
            $table->dropConstrainedForeignId('service_type_id');

            // Revertir la opción de nullable en servicepricelist_id
            $table->foreignId('servicepricelist_id')->change();
           
        });
    }
};
