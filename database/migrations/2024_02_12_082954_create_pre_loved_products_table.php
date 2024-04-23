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
        Schema::create('pre_loved_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pre_loved_id')->constrained();
            $table->string('product_name');
            $table->float('buy_price')->nullable();
            $table->dateTime('buy_date');
            $table->enum('used_status', ['unused', 'once', 'twice', 'thrice', 'more_than_three']);
            $table->enum('condition', ['new', 'good', 'fair', 'poor']);
            $table->float('sell_price')->nullable();
            $table->string('weight')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_loved_products');
    }
};
