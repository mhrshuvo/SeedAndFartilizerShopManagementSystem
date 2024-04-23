<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\v1\Coupon;
use App\Models\v1\Order;
use App\Models\v1\Product;
use App\Models\v1\Referral;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static where(string $string, mixed $email)
 */
class User extends Authenticatable implements FilamentUser
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
        'phone_no',
        'avatar',
        'onboard_by',
        'otp',
        'email_verified_at'
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
        'password' => 'hashed',
    ];

    public function canAccessPanel(Panel $panel): bool
    {

        return $this->email == ('18103361@iubat.edu' && $this->role == 0) || (str_ends_with($this->email, '@kp.brand.com') && $this->role == 2);
    }

    public function orders() : HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function refer() : HasMany
    {
        return $this->hasMany(Referral::class , 'referrer' , 'id');
    }
    public function coupons() : HasMany
    {
        return $this->hasMany(Coupon::class , 'owned_by' , 'id');
    }
    public function product() : HasMany
    {
        return $this->hasMany(Product::class);
    }
}
