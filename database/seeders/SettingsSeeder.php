<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = new Setting();
        $settings->website_name = 'Website Name';
        $settings->website_url = 'https://example.com';
        $settings->page_title = 'Home Page Title';
        $settings->meta_keyword = 'Site Keywords';
        $settings->meta_description = 'Site Description';
        $settings->logotipo = 'uploads/settings/logo.jpeg';
        $settings->company_name = 'Company Name';
        $settings->contact_email = 'contact@example.com';
        $settings->admin_email = 'admin@example.com';
        $settings->billing_email = 'billing@example.com';
        $settings->zip_code = '12345-678';
        $settings->address1 = 'Company Address 1';
        $settings->address2 = 'Company Address 2';
        $settings->phone1 = '+1234567890';
        $settings->phone2 = '+9876543210';
        $settings->phone3 = '+2468135790';
        $settings->country = 'Company Country';
        $settings->banner_section = 'Default Banner Section';
        $settings->number_images_trending = 16;
        $settings->tax_code_name1 = 'Tax 1';
        $settings->tax_code_value1 = 10.00;
        $settings->tax_code_name2 = 'Tax 2';
        $settings->tax_code_value2 = 5.50;
        $settings->tax_code_name3 = 'Tax 3';
        $settings->tax_code_value3 = 7.25;

        $settings->facebook = 'https://www.facebook.com/example';
        $settings->instagram = 'https://www.instagram.com/example';
        $settings->twitter = 'https://twitter.com/example';
        $settings->tiktok = 'https://www.tiktok.com/example';
        $settings->youtube = 'https://www.youtube.com/example';

        $settings->quantity_unit = 'Units';
        $settings->shipping_mode = 'Default Shipping Mode';
        $settings->payment_mode = 'Default Payment Mode';
        $settings->currency_type = 'USD';

        $settings->save();
    }
}
