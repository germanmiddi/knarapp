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
        Schema::create('request_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requests_id')->constrained('requests');
            $table->foreignId('servicepricelists_id')->constrained('servicepricelists');

            $table->date("date")->nullable();
            $table->time("time")->nullable();

            $table->unsignedBigInteger('location_from');
            $table->foreign('location_from')->references('id')->on('locations')
                   ->onDelete('cascade')
                   ->onUpdate('cascade');

            $table->unsignedBigInteger('location_to');
            $table->foreign('location_to')->references('id')->on('locations')
                   ->onDelete('cascade')
                   ->onUpdate('cascade');
    
            $table->string("flight_number")->nullable();
            $table->foreignId('status_id')->constrained('request_services_status');
            $table->foreignId('driver_id')->constrained('drivers');
            

            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')
                   ->onDelete('cascade')
                   ->onUpdate('cascade');
            
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users')
                   ->onDelete('cascade')
                   ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_services');
    }
};
