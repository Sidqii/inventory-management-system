<?php

namespace App\Models\Catalog;

use App\Models\Inventory\Stock;
use App\Models\Transaction\StockMovement;
use App\Models\Transaction\StockRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'location',
    ];

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }

    public function stockRequests()
    {
        return $this->hasMany(StockRequest::class);
    }
}
