<?php

namespace App\Http\Requests\Admin\Product;


use Dboro\LaravelStart\Requests\StoreRequest;

class StoreProductRequest extends StoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:50', 'unique:products'],
            'slug' => ['required', 'min:3', 'max:50', 'alpha_dash', 'unique:products'],
            'description' => ['max:255']
        ];
    }


}
