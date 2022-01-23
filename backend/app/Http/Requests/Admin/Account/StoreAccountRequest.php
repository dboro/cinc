<?php

namespace App\Http\Requests\Admin\Account;


use Dboro\LaravelStart\Requests\StoreRequest;

class StoreAccountRequest extends StoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:50', 'unique:accounts'],
            'slug' => ['required', 'min:3', 'max:50', 'alpha_dash', 'unique:accounts'],
            'product_id' => ['required', 'exists:products,id'],
            'description' => ['string', 'max:255']
        ];
    }


}
