<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
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
            $categoryId = $this->route('category') ? $this->route('category')->id : null;

            return [
                'name' => [
                    'required',
                    'string',
                    Rule::unique('categories')->ignore($categoryId),
                ],
                'description' => 'required',
                'image' => 'nullable|mimes:jpg,jpeg,png',
                'meta_title' => 'required|string',
                'status' => 'required|integer',
                'meta_keyword' => 'required|string',
                'meta_description' => 'required',
            ];
        }
}
