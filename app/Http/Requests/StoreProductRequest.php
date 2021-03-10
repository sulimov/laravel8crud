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
     * @return array
     */
    public function rules()
    {
        $productId = $this->route('product');

        return [
            'title' => 'required|unique:products,title,' . $productId . '|max:255',
            'description' => 'max:512',
            'price' => 'required|numeric',
            'image' => 'nullable|mimes:jpg,gif,png|max:2048',
            'additional_images' => 'nullable|mimes:jpg,gif,png|max:2048',
        ];
    }
}
