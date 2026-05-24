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
        // 1. Categories Table
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });

        // 2. Products Table
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('ingredients')->nullable();
            $table->string('skin_type')->nullable(); // recommended skin type: Dry, Oily, Sensitive, All, etc.
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);
            $table->string('image_path')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });

        // 3. Orders Table
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();
            $table->string('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_country');
            $table->decimal('total', 10, 2);
            $table->string('status')->default('pending'); // pending, paid, shipped, cancelled
            $table->string('payment_gateway')->default('mock'); // stripe, paypal, mock
            $table->string('payment_id')->nullable(); // transaction reference
            $table->timestamps();
        });

        // 4. Order Items Table
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
    }
};
