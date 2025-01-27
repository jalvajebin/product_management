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
            $table->string('name')->nullable();
            $table->string('handle')->nullable();
            $table->string('code')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('special_price')->nullable();
            $table->integer('stock')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('is_active')->nullable()->default(true);
            $table->string('image_name')->nullable();
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
