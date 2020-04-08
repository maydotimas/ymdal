<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GetDrItemStatusQty extends Migration
{
    public function up()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS GetDRItemQtyStatus');
        DB::unprepared('
           CREATE FUNCTION `GetDRItemQtyStatus`(_dr_no varchar(200),_new_status varchar(200)
                    ) RETURNS varchar(200) CHARSET utf8
                DETERMINISTIC
            BEGIN
            DECLARE _count integer;
            DECLARE _confirmed integer;
            DECLARE _status varchar(200);

            select count(*) into _count from dr_items WHERE dr_no = _dr_no;
            select count(*) into _confirmed from dr_items where dr_no = _dr_no AND `status` = _new_status;

            select concat(_confirmed,"/",_count) into _status;

         return _status;
        END
        ');
    }

    public function down()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS GetDRItemQtyStatus');
    }
}
