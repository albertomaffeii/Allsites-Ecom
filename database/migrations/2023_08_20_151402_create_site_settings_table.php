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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title');
            $table->string('company_name');
            $table->string('contact_email');
            $table->string('admin_email');
            $table->string('billing_email');
            $table->string('zip_code');
            $table->string('address1');
            $table->string('address2');
            $table->string('country');
            $table->string('image');
            $table->string('banner_section');
            $table->string('number_images_trending');
            $table->string('tax_code_name1');
            $table->string('tax_code_value1');
            $table->string('tax_code_name2');
            $table->string('tax_code_value2');
            $table->string('tax_code_name3');
            $table->string('tax_code_value3');
            $table->string('phone');
            $table->string('fax');
            $table->string('whatsapp');
            $table->string('instagram');
            $table->string('twitter');
            $table->string('facebook');
            $table->string('tiktok');
            $table->string('website');
            $table->string('quantity_unit')->nullable();
            $table->string('shipping_mode');
            $table->string('payment_mode');
            $table->string('currency_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
