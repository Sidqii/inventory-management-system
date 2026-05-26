<?php

namespace App\Models\Transaction;

use App\Models\Catalog\Product;
use Illuminate\Database\Eloquent\Model;

class StockMovementItem extends Model
{
    protected $fillable = [
        'stock_movement_id',
        'product_id',
        'quantity',
    ];

    public function casts()
    {
        return [
            'quantity' => 'integer'
        ];
    }

    public function stockMovement()
    {
        return $this->belongsTo(StockMovement::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
