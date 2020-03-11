<?php

namespace App\Http\Controllers\Encoder;

use App\Audit;
use App\DR_Item;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TransactionController;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class InTransitController extends TransactionController
{
    public function __construct()
    {
        parent::__construct('intransit', 'intransit', 'encoder', 'transaction');
    }
}
