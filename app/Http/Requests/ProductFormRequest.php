<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'small_description' => 'required|string',
            'description' => 'required|string',
            'original_price' => 'required|numeric|regex:/^\d+(\.\d{1,4})?$/',
            'selling_price' => 'required|numeric|regex:/^\d+(\.\d{1,4})?$/',
            'quantity' => 'required|regex:/^\d+(\.\d{1,4})?$/',
            'quantity_unit' => 'required|string',
            'featured' => 'nullable|in:0,1',
            'trending' => 'nullable|in:0,1',
            'status' => 'nullable|in:0,1',
            'sku' => 'nullable|max:60',
            'packaging_type' => 'nullable|max:60',
            'meta_title' => 'required|string|max:255',
            'meta_keyword' => 'required|string',
            'meta_description' => 'required|string',
            'gross_weight' => 'required|numeric|regex:/^\d+(\.\d{1,4})?$/',
            'net_weight' => 'required|numeric|regex:/^\d+(\.\d{1,4})?$/',
            'height' => 'numeric|regex:/^\d+(\.\d{1,4})?$/',
            'width_or_diameter' => 'required|numeric|regex:/^\d+(\.\d{1,4})?$/',
            'length' => 'required|numeric|regex:/^\d+(\.\d{1,4})?$/',
            'image' => 'nullable',
        ];

    }
}
