<?php

namespace App\Models\Transaction;

use App\Models\Catalog\Product;
use Illuminate\Database\Eloquent\Model;

class StockRequestItem extends Model
{
    protected $fillable = [
        'stock_request_id',
        'product_id',
        'quantity_requested',
        'quantity_approved',
        'quantity_issued',
        'note',
    ];
    protected function casts()
    {
        return [
            'quantity_requested' => 'integer',
            'quantity_approved' => 'integer',
            'quantity_issued' => 'integer',
        ];
    }

    public function stockRequest()
    {
        return $this->belongsTo(StockRequest::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
