<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CsvUpload extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csv_upload', function (Blueprint $table) {
            $table->bigIncrements('id');;
            $table->string('file_name');
            $table->string('file_size');
            $table->integer('dr_count')->default(0);
            $table->integer('dr_item_count')->default(0);
            $table->string('path');
            $table->integer('loaded_to_production');
            $table->dateTime('loaded_to_production_date')->nullable();
            $table->integer('uploaded_by');
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
        Schema::dropIfExists('csv_upload');
    }
}
