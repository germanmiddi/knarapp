<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drivers', function (Blueprint $table) {
            // Modifica las columnas existentes para permitir valores nulos
            $table->string('phone')->nullable()->change();
            $table->string('lastname')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('vehicle')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drivers', function (Blueprint $table) {
            // Revierte los cambios, pero en este caso no se puede volver atrás en la restricción de nulos
            // Puedes dejar esta función vacía o eliminarla si no deseas revertir estos cambios.
        });
    }
}
