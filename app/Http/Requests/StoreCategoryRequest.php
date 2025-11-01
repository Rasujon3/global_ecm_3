<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_name' => 'required|string|max:50|unique:categories',
            'status' => 'required|in:Active,Inactive',
            'is_top' => 'required|in:0,1',
            'is_featured' => 'required|in:0,1',
            'is_homepage' => 'required|in:0,1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
