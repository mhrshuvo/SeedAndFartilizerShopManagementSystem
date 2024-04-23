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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('tracking_id')->unique()->index();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('district_id');
            $table->longText('address');
            $table->string('contact_no');
            $table->decimal('sub_total');
            $table->string('coupon_code')->nullable();
            $table->decimal('coupon_discount')->default(0);
            $table->decimal('delivery_charge');
            $table->decimal('vat');
            $table->decimal('total_price');
            $table->longText('note')->nullable();
            $table->string('status')->default('pending');
          
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->foreign('district_id')
                ->references('id')->on('districts');
            $table->foreign('division_id')
                ->references('id')->on('divisions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
