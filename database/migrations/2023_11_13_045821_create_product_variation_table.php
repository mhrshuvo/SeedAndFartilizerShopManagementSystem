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
        Schema::create('product_variation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('variation_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity')->default(1);
            $table->foreign('variation_id')->references('id')->on('product_variations');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variation');
    }
};
