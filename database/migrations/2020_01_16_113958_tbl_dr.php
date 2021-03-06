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
            $table->string('dr_no');
            $table->string('atp_no');
            $table->string('dr_date');
            $table->string('outlet_code');
            $table->string('sdr_no');
            $table->string('po_no');
            $table->string('carrier_code');
            $table->string('dispatch');
            $table->string('region');
            $table->string('transit_days');
            $table->integer('item_qty')->default(0);
            $table->enum('status',['PENDING','INTRANSIT','CONFIRMED','DELIVERED','BACKLOAD','RECALLED']);
            $table->dateTime('date_delivered')->nullable();
            $table->integer('csv_id');
            $table->timestamps();
            $table->index(['dr_no', 'status']);
            $table->index(['dr_no']);
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
