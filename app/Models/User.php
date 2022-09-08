<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'date_of_birth',
        'visits',
        'tier_points',
        'tier_id', 'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }
    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'user_id', 'id');
    }
    public function addresses()
    {
        return $this->hasMany(UserAddress::class, 'user_id', 'id');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id', 'id');
    }
    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id', 'id');
    }
    public function tier()
    {
        return $this->belongsTo(UserTier::class, 'tier_id', 'id');
    }
}
