<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblDr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('dr');
        Schema::create('dr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dr_no')->index();
            $table->string('atp_no')->index();
            $table->string('dr_date');
            $table->string('outlet_code');
            $table->string('sdr_no');
            $table->string('po_no');
            $table->string('carrier_code');
            $table->string('dispatch');
            $table->string('region');
            $table->string('transit_days');
            $table->integer('item_qty')->default(0);
            $table->enum('status',['PENDING','INTRANSIT','CONFIRMED','DELIVERED','BACKLOAD']);
            $table->dateTime('date_delivered')->nullable();
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
        Schema::dropIfExists('dr');
    }
}
