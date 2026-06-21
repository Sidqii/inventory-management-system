<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdempotencyKey extends Model
{
    protected $fillable = [
        'user_id',
        'key',
        'method',
        'path',
        'status_code',
        'response_body',
    ];

    protected $casts = [
        'response_body' => 'array'
    ];
}
