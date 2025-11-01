<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'nullable|email|unique:users,email,' . user()->id,
            'phone' => 'nullable|string|unique:users,phone,' . user()->id,
            'full_address' => 'required',
            'zip_code' => 'nullable|numeric',
            'paymentmethod_id' => 'required|integer|exists:paymentmethods,id',
            'image' => 'nullable',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $this->all();

            if (empty($data['email']) && empty($data['phone'])) {
                $validator->errors()->add('email', 'Either email or phone is required.');
                $validator->errors()->add('phone', 'Either email or phone is required.');
            }

            if (isset($data['paymentmethod_id']) && $data['paymentmethod_id'] == 2 && empty($data['image'])) {
                $validator->errors()->add('image', 'Image is required when payment method is Bank Payment.');
            }

            if (isset($data['paymentmethod_id']) && $data['paymentmethod_id'] == 3 && empty($data['image'])) {
                $validator->errors()->add('image', 'Image is required when payment method is bKash Payment.');
            }
        });
    }
}
