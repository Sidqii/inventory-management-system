<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enum\Role;
use App\Models\Inventory\Audit;
use App\Models\Catalog\Attachment;
use App\Models\Transaction\StockMovement;
use App\Models\Transaction\StockRequest;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Attributes\Fillable;
// use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// #[Fillable([
//     'name',
//     'role',
//     'email',
//     'password',
// ])]

// #[Hidden([
//     'password',
//     'remember_token',
// ])]

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

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
