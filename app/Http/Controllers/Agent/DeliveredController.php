<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DeliveredController extends TransactionController
{
    public function __construct()
    {
        parent::__construct(
            'delivered',
            'delivered',
            'agent',
            'transaction',
            false,
            false,
            false);
    }
}
