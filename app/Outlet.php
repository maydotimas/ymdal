<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $table ='outlet';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dealer_code','outlet_cluster','outlet_code','outlet_name','outlet_address','city','province','region','area','outlet_leadtime','outlet_mobile'
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

    public function dealers()
    {
        return $this->belongsTo('App\Dealer','dealer_code','dealer_code');
    }
}
