<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role',
        'status',
        'branch_id',
        'is_floating',

        // --- NEW 2FA DESTINATIONS ---
        'phone_number',
        'chat_id_telegram',
        'chat_id_viber',

        // --- NEW 2FA SWITCHES ---
        'two_factor_sms',
        'two_factor_gmail',
        'two_factor_yahoo',
        'two_factor_viber',
        'two_factor_telegram'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',

            // --- NEW 2FA BOOLEAN CASTS ---
            'is_floating' => 'boolean',
            'two_factor_sms' => 'boolean',
            'two_factor_gmail' => 'boolean',
            'two_factor_yahoo' => 'boolean',
            'two_factor_viber' => 'boolean',
            'two_factor_telegram' => 'boolean',
        ];
    }

    public function branch(): BelongsTo
    {
        // Because you named the column 'branch_id',
        // Laravel automatically maps this to the branches table.
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
