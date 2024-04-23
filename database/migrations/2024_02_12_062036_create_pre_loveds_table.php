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
        Schema::create('pre_loveds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('contact_no');
            $table->longText('image');
            $table->enum('want_to_do',['sell','donate']);
            $table->string('org_name')->nullable();
            $table->json('payout_account')->nullable();
            $table->enum('status',['pending','approved','rejected','live','down','donated'])->default('pending');
            $table->longText('note')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('pre_loveds');
    }
};
