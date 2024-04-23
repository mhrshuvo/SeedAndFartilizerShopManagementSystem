<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code')->unique()->index();
            $table->integer('min_spend');
            $table->dateTime('expired_at');
            $table->decimal('discount_percent')->nullable();
            $table->decimal('discount')->nullable();
            $table->integer('discount_limit');
            $table->string('used')->default(0);
            $table->longText('t_and_c')->nullable();
            $table->enum('type',['flat','percent','referral','custom']);
            $table->enum('status',['active','inactive'])->default('active');
            $table->unsignedBigInteger('owned_by')->nullable();
            $table->json('used_by')->nullable();
            $table->timestamps();
            $table->foreign('owned_by')->references('id')->on('users');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
