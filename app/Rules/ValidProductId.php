<?php

namespace App\Rules;

use App\Repositories\ProductsRepository;
use Illuminate\Contracts\Validation\Rule;

class ValidProductId implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return app(ProductsRepository::class)->getById($value) !== null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Product does not exist or can not be bought';
    }
}
