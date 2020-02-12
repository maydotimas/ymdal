<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImportDealer extends Migration
{
    public function up()
    {
        DB::unprepared('
            CREATE FUNCTION `ImportDealer`(
                _csv_id integer
            ) RETURNS integer
                DETERMINISTIC
            BEGIN
                DECLARE _count integer default 0;
                INSERT INTO dealer (dealer_code, dealer_name, csv_id, created_at, updated_at )
                    SELECT distinct dealer_code, dealer_name,_csv_id, now(), now()
                    FROM branch_outlet_csv_upload
                    WHERE csv_id = _csv_id;

                select count(distinct dealer_code) into _count from dealer WHERE csv_id = _csv_id;
             return _count;
            END
        ');
    }

    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ImportDrItem');
    }
}
