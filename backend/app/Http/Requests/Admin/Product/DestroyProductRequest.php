<?php

namespace App\Http\Requests\Admin\Product;


use App\Models\Admin\Product;
use Dboro\LaravelStart\Requests\DestroyRequest;

class DestroyProductRequest extends DestroyRequest
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

        ];
    }


}
