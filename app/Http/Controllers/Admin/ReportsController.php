<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function per_transaction(){
        return view('reports.index')
            ->with('active','reports')
            ->with('title', 'PER TRANSACTION REPORTS');
    }
}
