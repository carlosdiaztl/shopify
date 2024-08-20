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
        Schema::create('shopify', function (Blueprint $table) {
            $table->id();
            $table->string('store');
            $table->string('token_shopify');
            $table->string('secret_key_shopify');
            $table->string('api_key_shopify');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopify');
    }
};
