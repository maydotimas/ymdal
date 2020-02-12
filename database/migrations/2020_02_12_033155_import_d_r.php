<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImportDR extends Migration
{
    public function up()
    {
        DB::unprepared('
        CREATE FUNCTION `ImportDr`(
            _csv_id integer,
            _status varchar(200)
        ) RETURNS int(11)
            DETERMINISTIC
        BEGIN
            DECLARE _count integer default 0;
            INSERT INTO dr (dr_no, atp_no, dr_date, outlet_code, sdr_no, po_no, carrier_code, dispatch, region, transit_days, `status`, csv_id, created_at, updated_at )
                SELECT distinct nav_dr_no, nav_atp_no, nav_dr_date, outlet_code, nav_sdr_no, nav_po_no,  nav_carrier, nav_dispatch, nav_region, nav_transit_days, _status, _csv_id, now(), now()
                FROM dr_csv_content
                WHERE csv_id = _csv_id;
            select count(*) into _count from dr WHERE csv_id = _csv_id;
         return _count;
        END
        ');
    }

    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ImportDr');
    }
}
