<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchUpload extends Model
{
    protected $table ='branch_upload';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file_name','file_size', 'dealer_count', 'outlet_count', 'loaded_to_production', 'loaded_to_production_date', 'uploaded_by','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
