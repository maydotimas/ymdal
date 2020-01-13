<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadCsvController extends Controller
{
    public function index(){
        return view('csv.index')
            ->with('active','csv-upload');
    }
    public function upload(){

    }
    public function history(){
        return view('csv.history')
            ->with('active','csv-history');
    }
    public function upload_to_production(){

    }
}

