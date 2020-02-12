<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ResetTempUpdate extends Migration
{
    public function up()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS ResetTempUpdate');
        DB::unprepared('
            CREATE FUNCTION `ResetTempUpdate`(
                _user_id varchar(200)
            ) RETURNS int(11)
                DETERMINISTIC
            BEGIN
                UPDATE dr_items set `status` = `original_status`, is_updated = null where updated_by = _user_id;
                UPDATE dr_items set `updated_by` = null, is_updated = null where updated_by = _user_id;

             return 0;
            END
        ');
    }

    public function down()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS ResetTempUpdate');
    }
}
