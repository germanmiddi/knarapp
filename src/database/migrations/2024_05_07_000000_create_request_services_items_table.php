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
        Schema::create('request_services_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requests_id')->constrained('requests');
           
            $table->foreignId('request_service_id')->constrained('request_services');
            
            $table->string('item_type');
            $table->string('description')->nullable();
            $table->float('price')->nullable();
            
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
        Schema::dropIfExists('role_user');
    }
};
