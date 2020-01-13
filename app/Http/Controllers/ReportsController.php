<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function per_transaction(){
        return view('reports.index')
            ->with('active','reports');
    }
}
