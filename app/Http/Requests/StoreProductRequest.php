<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'category_id' => 'required|integer|exists:categories,id',
            'subcategory_id' => 'nullable|integer|exists:subcategories,id',
            'brand_id' => 'nullable|integer|exists:brands,id',
            'unit_id' => 'required|integer|exists:units,id',
            'product_name' => 'required|string|max:50|unique:products',
            'product_price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'stock_qty' => 'required|numeric',
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpg,jpeg,png',
            'description' => 'required',
            'is_arrival_product' => 'required|in:0,1',
            'is_best_seller' => 'required|in:0,1',
            'tag' => 'nullable|string|max:100',
        ];
    }
}
