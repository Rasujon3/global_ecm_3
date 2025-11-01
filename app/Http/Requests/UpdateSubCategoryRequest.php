<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubCategoryRequest extends FormRequest
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
            'subcategory_name' => 'required|string|max:50|unique:subcategories,subcategory_name,' . $this->subcategory->id,
            'status' => 'required|in:Active,Inactive',
            'is_mega_menu' => 'required|in:0,1',
        ];
    }
}
