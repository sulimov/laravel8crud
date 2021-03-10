<?php

namespace App\Http\Requests\Cart;

use App\Repositories\CartRepository;
use App\Repositories\ProductsRepository;
use App\Rules\ValidProductId;
use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
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
        return [
            'product_id' => ['required', 'integer', new ValidProductId],
            'count' => ['required', 'integer', 'min:1', 'max:'.CartRepository::MAX_PRODUCT_COUNT],
        ];
    }
}
