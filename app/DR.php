<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DR extends Model
{
    protected $table ='dr';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dr_no','dr_date', 'outlet_code', 'sdr_no', 'po_no', 'carrier_code', 'dispatch', 'region','transit_days', 'status', 'date_delivered', 'csv_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'dr_date' => 'date',
        'date_delivered' => 'date',
    ];

    public function dr_items()
    {
        return $this->hasMany('App\DR_Item','dr_no','dr_no');
    }

    public function history()
    {
        return $this->hasMany('App\DR_History','dr_no','dr_no');
    }


}
