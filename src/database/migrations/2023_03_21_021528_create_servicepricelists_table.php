<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicepricelistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicepricelists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->float('price');
            $table->boolean('active');
            $table->unsignedBigInteger('created_by');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')
                   ->onDelete('cascade')
                   ->onUpdate('cascade');

            $table->foreign('created_by')->references('id')->on('users')
                   ->onDelete('cascade')
                   ->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicepricelists');
    }
}
