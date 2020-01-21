<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DR_Item extends Model
{
    protected $table ='dr_items';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dr_no','model_code', 'model_name', 'frame_no', 'engine_no', 'sdr_no', 'po_no', 'delivery_date','status',
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

    public function dr()
    {
        return $this->belongsTo('App\DR','dr_no','dr_no');
    }

    public function history()
    {
        return $this->hasMany('App\DR_Item_History','dr_no','dr_no');
    }
}
