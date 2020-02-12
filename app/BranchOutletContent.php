<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchOutletContent extends Model
{
    protected $table ='branch_outlet_csv_upload';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dealer_code',
        'dealer_name',
        'outlet_code',
        'outlet_name',
        'outlet_cluster',
        'outlet_address',
        'outlet_city',
        'outlet_province',
        'outlet_region',
        'outlet_area',
        'outlet_leadtime',
        'outlet_mobile',
        'csv_id'
    ];


}
