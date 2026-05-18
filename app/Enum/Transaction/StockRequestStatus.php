<?php

namespace App\Enum\Transaction;

enum StockRequestStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case FULFILLED = 'fulfilled';
}
