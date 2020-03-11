<?php

namespace App\Http\Controllers\Encoder;

use App\Http\Controllers\TransactionController;

class PendingTransactionController extends TransactionController
{
    public function __construct()
    {
        parent::__construct('pending', 'intransit', 'encoder', 'transaction');
    }
}
