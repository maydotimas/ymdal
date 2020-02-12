<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImporDRItem extends Migration
{
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ImportDrItem');
        DB::unprepared('
            CREATE FUNCTION `ImportDrItem`(
                _csv_id integer,
                _status varchar(200)
            ) RETURNS int(11)
                DETERMINISTIC
            BEGIN
                DECLARE _count integer default 0;
                -- to do: add a unique key pairs for a dr record per insert para walang duplicate
                INSERT INTO dr_items (dr_no, model_code, model_name, frame_no, engine_no, sdr_no, po_no, `status`, created_at, updated_at, csv_id, original_status )
                    SELECT nav_dr_no, nav_model_code, nav_model_name, nav_frame_no, nav_engine_no, nav_sdr_no, nav_po_no, _status, now(), now() , _csv_id, _status
                    FROM dr_csv_content
                    WHERE csv_id = _csv_id;

                select count(nav_dr_no) into _count from dr_csv_content where csv_id = _csv_id;
                return _count;
            END
        ');
    }

    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ImportDrItem');
    }
}