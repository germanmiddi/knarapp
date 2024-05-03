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
           
            $table->boolean('baggage');
            $table->boolean('guide');
            $table->string('guide_name');

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
            $table->dropColumn('baggage');
            $table->dropColumn('guide');
            $table->dropColumn('guide_name');
                       
        });
    }
};
