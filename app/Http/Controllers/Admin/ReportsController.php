<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function per_transaction(){
        return view('admin.reports.index')
            ->with('active','reports')
            ->with('title', 'PER TRANSACTION REPORTS');
    }
}
