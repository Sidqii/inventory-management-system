<?php

namespace App\Models\Inventory;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'subject',
        'description',
        'properties',
        'ip_address',
        'user_agent',
        'created_at',
    ];

    public function auditor()
    {
        return $this->belongsTo(User::class);
    }
}
