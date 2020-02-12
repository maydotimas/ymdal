<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BranchOutletCsvContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('branch_outlet_csv_upload');
        Schema::create('branch_outlet_csv_upload', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('dealer_code');
            $table->string('dealer_name');
            $table->string('outlet_code');
            $table->string('outlet_name');
            $table->string('outlet_cluster');
            $table->string('outlet_address');
            $table->string('outlet_city');
            $table->string('outlet_province');
            $table->string('outlet_region');
            $table->string('outlet_area');
            $table->string('outlet_area_num');
            $table->string('outlet_mobile');
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
        Schema::dropIfExists('branch_outlet_csv_upload');
    }
}
