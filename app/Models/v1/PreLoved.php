<?php

namespace App\Models\v1;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreLoved extends Model
{
    use HasFactory;
    protected $fillable = [
        'contact_no',
        'user_id',
        'image',
        'payout_account',
        'want_to_do',
        'org_name',
        'status',
        'note',
        'product_id'
    ];
    protected $casts = [
        'payout_account' => 'json',
        'image' => 'array'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function pre_loved_products(){
        return $this->hasMany(PreLovedProduct::class);
    }
}
