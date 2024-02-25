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
            //create fields integer 
            $table->integer("pax_cant")->nullable()->after('driver_id');
            $table->string("pax_name")->nullable()->after('pax_cant');
            $table->string("pax_mail")->nullable()->after('pax_name');
            $table->string("pax_phone")->nullable()->after('pax_mail');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};