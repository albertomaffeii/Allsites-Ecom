<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
        'website_name' => 'Website Name',
        'website_url' => 'example.com',
        'page_title' => 'Home Page Title',
        'meta_keyword' => 'Site Keywords',
        'meta_description' => 'Site Description',
        'logotipo' => 'uploads/settings/logo.jpeg',
        'company_name' => 'Company Name',
        'contact_email' => 'contact@example.com',
        'admin_email' => 'admin@example.com',
        'billing_email' => 'billing@example.com',
        'zip_code' => '12345-678',
        'address1' => 'Company Address 1',
        'address2' => 'Company Address 2',
        'phone1' => '+12 345.678.9012',
        'phone2' => '(+98)7.6543.2101',
        'phone3' => '0039 246 8135790',
        'country' => 'Company Country',
        'banner_section' => 'Default Banner Section',
        'number_images_trending' => 16,
        'tax_code_name1' => 'Exemple P.Iva',
        'tax_code_value1' => '12.345.676/0001-99',
        'tax_code_name2' => 'Exemple REA',
        'tax_code_value2' => 'MI.12345-ABCDE',
        'tax_code_name3' => 'VAT/TAX Included',
        'tax_code_value3' => '12.1234',
        'facebook' => 'https://www.facebook.com/example',
        'instagram' => 'https://www.instagram.com/example',
        'twitter' => 'https://twitter.com/example',
        'tiktok' => 'https://www.tiktok.com/example',
        'youtube' => 'https://www.youtube.com/example',
        'quantity_unit' => 'Units',
        'shipping_mode' => 'Default Shipping Mode',
        'payment_mode' => 'Default Payment Mode',
        'currency_type' => 'US$',
        'format_date' => 'Y-m-d',
        'format_hour' => 'g:i A',
        'format_number' => '\'.\', \',\'',
    ]);
    }
}
