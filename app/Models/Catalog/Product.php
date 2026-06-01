<?php

namespace App\Models\Catalog;

use App\Models\Inventory\Stock;
use App\Models\Transaction\StockMovementItem;
use App\Models\Transaction\StockRequestItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'unit_id',
        'sku',
        'name',
        'description',
        'minimum_stock',
        // 'image_path',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function stockRequestItems()
    {
        return $this->hasMany(StockRequestItem::class);
    }

    public function stockMovementItems()
    {
        return $this->hasMany(StockMovementItem::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
