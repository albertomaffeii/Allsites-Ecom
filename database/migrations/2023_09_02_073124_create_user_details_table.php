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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('personal_tax_code', 20)->nullable();
            $table->string('billing_email', 121)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('pin_code', 10)->nullable();
            $table->string('country', 20)->nullable();
            $table->text('address', 500)->nullable();
            $table->string('profile_image', 100)->nullable();
            $table->text('panel_color', 20)->default('bg-light');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

     /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
