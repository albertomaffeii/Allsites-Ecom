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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_name');
            $table->string('website_url');
            $table->string('page_title');
            $table->string('meta_keyword', 500);
            $table->string('meta_description', 500);
            $table->string('logotipo')->nullable();

            $table->string('company_name', 120);
            $table->string('contact_email', 150);
            $table->string('admin_email', 150)->nullable();
            $table->string('billing_email', 150)->nullable();
            $table->string('zip_code',9);
            $table->string('address1', 250);
            $table->string('address2', 250)->nullable();
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('phone3')->nullable();
            $table->string('country')->nullable();
            $table->string('banner_section')->nullable();
            $table->integer('number_images_trending');
            $table->string('tax_code_name1');
            $table->decimal('tax_code_value1', 5, 2);
            $table->string('tax_code_name2')->nullable();
            $table->string('tax_code_value2', 5, 2)->nullable();
            $table->string('tax_code_name3')->nullable();
            $table->string('tax_code_value3', 5, 2)->nullable();

            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('youtube')->nullable();

            $table->string('quantity_unit')->nullable();
            $table->string('shipping_mode')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('currency_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
