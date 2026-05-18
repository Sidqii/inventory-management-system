<?php

namespace App\Models\Transactions;

use App\Models\Catalog\Warehouse;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $fillable = [
        'user_id',
        'warehouse_id',
        'reference_type',
        'reference_id',
        'movement_type',
        'movement_number',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function items()
    {
        return $this->hasMany(StockMovementItem::class);
    }

    public function reference()
    {
        return $this->morphTo();
    }
}
