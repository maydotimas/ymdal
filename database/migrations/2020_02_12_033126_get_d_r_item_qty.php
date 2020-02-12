<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GetDRItemQty extends Migration
{
    public function up()
    {
        DB::unprepared('DROP Function IF EXISTS GetDRItemQty');
        DB::unprepared('
        CREATE FUNCTION `GetDRItemQty`(
            _dr_no varchar(200)
        ) RETURNS varchar(200)
            DETERMINISTIC
        BEGIN
            DECLARE _count integer default 0;
            DECLARE _confirmed integer default 0;
            DECLARE _status varchar(200);

            select count(*) into _count from dr_items WHERE dr_no = _dr_no;
            select count(*) into _confirmed from dr_items where dr_no = _dr_no AND `status` = "CONFIRMED";

            select concat(_confirmed,"/",_count) into _status;

         return _status;
        END
        ');
    }

    public function down()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS GetDRItemQty');
    }
}
