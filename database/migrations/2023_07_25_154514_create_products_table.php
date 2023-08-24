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
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->string('name');
            $table->string('slug')->unique();
            $table->string('brand')->nullable;
            $table->mediumText('small_description')->nullable;
            $table->longText('description')->nullable;

            $table->decimal('original_price', 10, 2);
            $table->decimal('selling_price', 10, 2);

            $table->string('sku')->nullable();
            $table->decimal('quantity', 10, 4);
            $table->string('quantity_unit')->nullable();
            $table->tinyInteger('trending')->default('0')->comment('0=not-trending, 1=trending');
            $table->tinyInteger('featured')->default('0')->comment('0=not-featured, 1=featured');
            $table->tinyInteger('status')->default('0')->comment('0=visible, 1=hidden');

            $table->decimal('gross_weight', 10, 4)->nullable();
            $table->decimal('net_weight', 10, 4)->nullable();
            $table->string('packaging_type')->nullable();
            $table->decimal('height', 10, 2)->nullable();
            $table->decimal('width_or_diameter', 10, 2)->nullable();
            $table->decimal('length', 10, 2)->nullable();

            $table->string('meta_title');
            $table->string('meta_keyword');
            $table->mediumText('meta_description');
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
