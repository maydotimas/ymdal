<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CsvUpload extends Model
{
    protected $table ='csv_upload';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file_name','file_size', 'path', 'loaded_to_production', 'uploaded_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

}
