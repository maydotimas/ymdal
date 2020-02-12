<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DrItemHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('dr_item_history');
        Schema::create('dr_item_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dr_no');
            $table->string('nav_engine_no');
            $table->string('previous_status');
            $table->string('current_status');
            $table->string('action');
            $table->string('performed_by');
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
        Schema::dropIfExists('dr_item_history');
    }
}
