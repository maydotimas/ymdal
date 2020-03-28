<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function checkDR(Request $request){
        return view('layouts.dr_details');
    }
}
