<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enum\Role;
use App\Models\Inventory\Audit;
use App\Models\Catalog\Attachment;
use App\Models\Transactions\StockMovement;
use App\Models\Transactions\StockRequest;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable([
    'name',
    'role',
    'email',
    'password',
])]

#[Hidden([
    'password',
    'remember_token',
])]

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'role' => Role::class,
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function stockRequests()
    {
        return $this->hasMany(StockRequest::class, 'user_id');
    }

    public function approvedStockRequests()
    {
        return $this->hasMany(StockRequest::class, 'approved_by');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'user_id');
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class, 'user_id');
    }

    public function auditLogs()
    {
        return $this->hasMany(Audit::class, 'user_id');
    }
}
