<?php

namespace App\Http\Controllers\Encoder;

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
            'confirmed',
            'confirmed',
            'encoder',
            'transaction',
            false,
            false,
            false);
    }
}
