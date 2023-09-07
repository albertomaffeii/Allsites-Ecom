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
            $table->integer('user_id');
            $table->string('tracking_no');
            $table->string('fullname',255)->nullable();
            $table->string('personal_tax_code',20)->nullable();
            $table->string('email',121);
            $table->string('billing_email',121);
            $table->string('phone',20)->nullable();
            $table->string('pincode',10)->nullable();
            $table->string('country',20)->nullable();
            $table->string('address',500)->nullable();
            $table->string('status_message');
            $table->string('payment_mode');
            $table->string('payment_id')->nullable();
            $table->timestamps();
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
