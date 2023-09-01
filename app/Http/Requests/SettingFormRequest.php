<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules()
    {
        return [
            'website_name' => ['required', 'string', 'max:255'],
            'website_url' => ['required', 'max:255'],
            'page_title' => ['required', 'string', 'max:255'],
            'meta_keyword' => ['required', 'string', 'max:500'],
            'meta_description' => ['required', 'string', 'max:500'],
            'logotipo' => ['nullable', 'max:2048'],
            'company_name' => ['required', 'string', 'max:120'],
            'contact_email' => ['required', 'email', 'max:150'],
            'admin_email' => ['nullable', 'email', 'max:150'],
            'billing_email' => ['nullable', 'email', 'max:150'],
            'zip_code' => ['required', 'string', 'max:9'],
            'address1' => ['required', 'string', 'max:250'],
            'address2' => ['nullable', 'string', 'max:250'],
            'phone1' => ['required', 'string'],
            'phone2' => ['nullable', 'string'],
            'phone3' => ['nullable', 'string'],
            'country' => ['nullable', 'string'],
            'banner_section' => ['nullable', 'string'],
            'number_images_trending' => ['required', 'integer'],
            'tax_code_name1' => ['required', 'string'],
            'tax_code_value1' => ['required', 'string'],
            'tax_code_name2' => ['nullable', 'string'],
            'tax_code_value2' => ['nullable', 'string'],
            'tax_code_name3' => ['nullable', 'string'],
            'tax_code_value3' => ['nullable', 'numeric'],
            'facebook' => ['nullable', 'string', 'url'],
            'instagram' => ['nullable', 'string', 'url'],
            'twitter' => ['nullable', 'string', 'url'],
            'tiktok' => ['nullable', 'string', 'url'],
            'youtube' => ['nullable', 'string', 'url'],
            'quantity_unit' => ['nullable', 'string'],
            'shipping_mode' => ['nullable', 'string'],
            'payment_mode' => ['nullable', 'string'],
            'currency_type' => ['nullable', 'string'],
            'format_date' => ['nullable'],
            'format_hour' => ['nullable'],
            'format_number' => ['nullable'],
        ];
    }
}
