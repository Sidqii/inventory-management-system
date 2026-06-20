<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enum\Role;
use App\Models\Inventory\Audit;
use App\Models\Catalog\Attachment;
use App\Models\Transaction\StockMovement;
use App\Models\Transaction\StockRequest;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;
use Override;

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

    #[Override]
    public function sendEmailVerificationNotification(): void
    {
        $verifyUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            [
                'id' => $this->getKey(),
                'hash' => sha1($this->getEmailForVerification()),
            ]
        );

        $this->notify(new class($verifyUrl) extends VerifyEmail {
            public function __construct(private string $verifyUrl) {}

            public function toMail($notifiable): MailMessage
            {
                return (new MailMessage)
                    ->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('Verify Your Email - Inventory App')
                    ->greeting('Hello ' . $notifiable->name . ' 👋')
                    ->line('Thank you for registering to Inventory App.')
                    ->line('Please verify your email address to continue using your account.')
                    ->action('Verify Email', $this->verifyUrl)
                    ->line('This verification link will expire in 60 minutes.')
                    ->line('If you did not create this account, you can ignore this email.');
            }
        });
    }
}
