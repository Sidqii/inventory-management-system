<?php

namespace App\Models\Inventory;

use App\Models\Catalog\Product;
use App\Models\Catalog\Warehouse;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'product_id',
        'warehouse_id',
        'quantity',
    ];

    protected function casts()
    {
        return [
            'quantity' => 'integer'
        ];
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
