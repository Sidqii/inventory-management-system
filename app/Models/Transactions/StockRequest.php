<?php

namespace App\Models\Transactions;

use App\Enum\Transaction\StockRequestStatus;
use App\Models\User;
use App\Models\Catalog\Warehouse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockRequest extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'warehouse_id',
        'request_number',
        'status',
        'note',
        'approved_at',
        'approved_by',
        'completed_at',
        'completed_by',
    ];
    protected function casts(): array
    {
        return [
            'status' => StockRequestStatus::class,
            'approved_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function items()
    {
        return $this->hasMany(StockRequestItem::class, 'stock_request_id');
    }

    public function completedBy()
    {
        return $this->belongsTo(User::class, 'completed_by');
    }
}
