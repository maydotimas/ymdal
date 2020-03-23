<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Outlet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('outlet');
        Schema::create('outlet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dealer_code');
            $table->string('outlet_code');
            $table->string('outlet_name');
            $table->string('outlet_cluster');
            $table->string('outlet_address');
            $table->string('outlet_city');
            $table->string('outlet_province');
            $table->string('outlet_region');
            $table->string('outlet_area');
            $table->string('outlet_leadtime');
            $table->string('outlet_mobile');
            $table->string('email')->nullable();
            $table->integer('csv_id');
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
        Schema::dropIfExists('outlet');
    }
}
