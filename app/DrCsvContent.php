<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrCsvContent extends Model
{
    protected $table = 'dr_csv_content';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nav_dr_no',
        'nav_atp_no',
        'nav_dr_date',
        'dealer_code',
        'dealer_name',
        'outlet_cluster',
        'outlet_code',
        'outlet_name',
        'nav_model_code',
        'nav_model_name',
        'nav_frame_no',
        'nav_engine_no',
        'nav_transit_days',
        'nav_carrier',
        'nav_dispatch',
        'nav_region',
        'nav_sdr_no',
        'nav_po_no',
        'csv_id',
        'status',
    ];


}
