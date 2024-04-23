<?php

namespace App\Jobs;

use App\Models\v1\Coupon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateCouponsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $referee;
    protected $referrer;

    public function __construct(string $referrer, string $referee)
    {
        $this->referrer = $referrer;
        $this->referee = $referee;
    }


    public function handle()
    {

         Coupon::create([
            'coupon_code' => strtoupper('KPR').rand(0, 9). '-' . rand(1000, 9999),
            'min_spend' => 100,
            'expired_at' => now()->addDays(30),
            'discount_percent' => 0,
            'discount' => 200,
            'discount_limit' => 200,
            'used' => 0,
            't_and_c' => 'This coupon is for the referrer',
            'type' => 'flat',
            'status' => 'active',
            'owned_by' => $this->referrer,
        ]);

        Coupon::create([
            'coupon_code' => strtoupper('KPR').rand(0, 9). '-' . rand(1000, 9999),
            'min_spend' => 100,
            'expired_at' => now()->addDays(30),
            'discount_percent' => 0,
            'discount' => 200,
            'discount_limit' => 200,
            'used' => 0,
            't_and_c' => 'This coupon is for the referee',
            'type' => 'flat',
            'status' => 'active',
            'owned_by' => $this->referee,
        ]);
    }
}
