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
            $table->bigInteger('request_id')->unsigned()->nullable(); 
            $table->date("date")->nullable();
            $table->time("time")->nullable();
            $table->bigInteger("location_from")->unsigned()->nullable();
            $table->bigInteger("location_to")->unsigned()->nullable();
            $table->string("flight_number")->nullable();
            $table->bigInteger("status_id")->unsigned()->nullable();
            $table->timestamps();
            
            $table->foreign('request_id')->references('id')->on('requests');
            $table->foreign('status_id')->references('id')->on('request_services_statuses');
            $table->foreign('location_from')->references('id')->on('locations');
            $table->foreign('location_to')->references('id')->on('locations');

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
