<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DrItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('dr_items');
        Schema::create('dr_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dr_no');
            $table->string('model_code');
            $table->string('model_name');
            $table->string('frame_no');
            $table->string('engine_no');
            $table->string('sdr_no');
            $table->string('po_no');
            $table->dateTime('delivery_date')->nullable();
            $table->enum('status',['PENDING','INTRANSIT','CONFIRMED','DELIVERED','BACKLOAD','RECALLED']);
            $table->dateTime('guard_out')->nullable();
            $table->dateTime('confirm_date')->nullable();
            $table->dateTime('deliver_date')->nullable();



            $table->string('original_status')->nullable();
            $table->string('is_updated')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('dr_items');
    }
}
