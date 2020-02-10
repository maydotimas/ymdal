<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    protected $table ='dealer';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dealer_code','dealer_name'
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

    public function dealer_outlets()
    {
        return $this->hasMany('App\Outlet','dealer_code','dealer_code');
    }

}
