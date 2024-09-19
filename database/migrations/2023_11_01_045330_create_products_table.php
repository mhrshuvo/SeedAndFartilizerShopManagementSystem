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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique()->index();
            $table->string('name');
            $table->longText('description');
            $table->string('thumbnail')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('sell_price', 10, 2);
            $table->string('slug')->index();
            $table->integer('stock')->default(2);
            $table->boolean('active')->default(true);
            $table->foreignId('user_id')->default(1)->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
