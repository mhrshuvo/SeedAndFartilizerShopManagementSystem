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
        Schema::create('referrals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('referral_code')->unique();
            $table->unsignedBigInteger('referrer')->nullable();
            $table->integer('used')->default(0);
            $table->integer('max')->default(0);
            $table->integer('referral_bonus')->default(0);
            $table->timestamps();
            $table->foreign('referrer')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
