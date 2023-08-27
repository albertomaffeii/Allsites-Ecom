<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $guarded = [];

    protected $fillable = [
        'website_name',
        'website_url',
        'page_title',
        'meta_keyword',
        'meta_description',
        'logotipo',
        'company_name',
        'contact_email',
        'admin_email',
        'billing_email',
        'zip_code',
        'address1',
        'address2',
        'phone1',
        'phone2',
        'phone3',
        'country',
        'banner_section',
        'number_images_trending',
        'tax_code_name1',
        'tax_code_value1',
        'tax_code_name2',
        'tax_code_value2',
        'tax_code_name3',
        'tax_code_value3',
        'facebook',
        'instagram',
        'twitter',
        'tiktok',
        'youtube',
        'quantity_unit',
        'shipping_mode',
        'payment_mode',
        'currency_type',
    ];

}
