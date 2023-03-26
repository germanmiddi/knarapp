<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
           
            $table->string('company_name')->nullable();
            $table->string('fullname')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();            
            $table->string('cellphone')->nullable();
            $table->string('address')->nullable();
            $table->string('zipcode', 10)->nullable();
            $table->string('cuit')->nullable();
            $table->string('billing_type')->nullable();
            $table->text('notes')->nullable(); 
            $table->unsignedBigInteger('client_type_id');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('client_type_id')->references('id')->on('client_types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
