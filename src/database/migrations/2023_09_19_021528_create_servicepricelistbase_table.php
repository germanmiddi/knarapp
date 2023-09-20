<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicepricelistbaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicepricelistsbase', function (Blueprint $table) {
            $table->id();
            $table->foreignId('services_id')->constrained();
            $table->float('wait_time')->nullable();
            $table->boolean('baggage');
            $table->boolean('guide');
            $table->integer('passenger_capacity')->nullable();
            $table->float('duration')->nullable();
            $table->float('price');
            $table->boolean('active');
            $table->softDeletes();
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
        Schema::dropIfExists('servicepricelistsbase');
    }
}
