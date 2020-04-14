<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DrCsvContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('dr_csv_content');
        Schema::create('dr_csv_content', function (Blueprint $table) {
            $table->bigIncrements('id');;
            $table->string('nav_dr_no');
            $table->string('nav_atp_no');
            $table->string('nav_dr_date');
            $table->string('dealer_code');
            $table->string('dealer_name');
            $table->string('outlet_cluster');
            $table->string('outlet_code');
            $table->string('outlet_name');
            $table->string('nav_model_code');
            $table->string('nav_model_name');
            $table->string('nav_frame_no');
            $table->string('nav_engine_no');
            $table->string('nav_transit_days');
            $table->string('nav_carrier');
            $table->string('nav_dispatch');
            $table->string('nav_region');
            $table->string('nav_sdr_no');
            $table->string('nav_po_no');
            $table->integer('csv_id');
            $table->enum('status',['PENDING','INTRANSIT','CONFIRMED','DELIVERED','BACKLOAD','RECALLED']);
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
        Schema::dropIfExists('dr_csv_content');
    }
}
