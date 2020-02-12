<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImportDealerOutlet extends Migration
{
    public function up()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS ImportDealerOutlet');
        DB::unprepared('
           CREATE FUNCTION `ImportDealerOutlet`(
                _csv_id integer
            ) RETURNS int(11)
                DETERMINISTIC
            BEGIN
                DECLARE _count integer default 0;
                INSERT INTO outlet (
                    outlet_code,
                    dealer_code,
                    outlet_name,
                    outlet_cluster,
                    outlet_address,
                    outlet_city,
                    outlet_province,
                    outlet_region,
                    outlet_area,
                    outlet_leadtime,
                    outlet_mobile,
                    csv_id,
                    created_at,
                    updated_at )
                    SELECT 
                    distinct outlet_code,
                    dealer_code,
                    outlet_name,
                    outlet_cluster,
                    outlet_address,
                    outlet_city,
                    outlet_province,
                    outlet_region,
                    outlet_area,
                    outlet_leadtime,
                    outlet_mobile,
                    csv_id, 
                    now(), 
                    now()
                    FROM branch_outlet_csv_upload
                    WHERE csv_id = _csv_id
                and outlet_code not in (
                    select outlet_code from outlet where outlet.outlet_code = branch_outlet_csv_upload.outlet_code
                    );
                    
                SELECT 
                COUNT(DISTINCT outlet_code)
                INTO _count FROM
                    outlet
                WHERE
                csv_id = _csv_id; 
             return _count;
            END
        ');
    }

    public function down()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS ImportDealerOutlet');
    }

}
