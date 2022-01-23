<?php

namespace App\Http\Requests\Admin\Product;


use App\Models\Admin\Product;
use Dboro\LaravelStart\Requests\UpdateRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends UpdateRequest
{
    protected ?string $modelClass = Product::class;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['sometimes', 'required', 'min:3', 'max:50',
                Rule::unique('products')->ignore($this->route('id'), 'id')],
            'slug' => ['sometimes', 'required', 'min:3', 'max:50', 'alpha_dash',
                Rule::unique('products')->ignore($this->route('id'), 'id')],
            'description' => ['max:255']
        ];
    }


}
