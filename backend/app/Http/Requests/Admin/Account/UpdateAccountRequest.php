<?php

namespace App\Http\Requests\Admin\Account;


use App\Models\Admin\Account;
use Dboro\LaravelStart\Requests\UpdateRequest;
use Illuminate\Validation\Rule;

class UpdateAccountRequest extends UpdateRequest
{
    protected ?string $modelClass = Account::class;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['sometimes', 'required', 'min:3', 'max:50',
                Rule::unique('accounts')->ignore($this->route('id'), 'id')],
            'slug' => ['sometimes', 'required', 'min:3', 'max:50', 'alpha_dash',
                Rule::unique('accounts')->ignore($this->route('id'), 'id')],
            'product_id' => ['sometimes', 'required', 'exists:products,id'],
            'description' => ['max:255']
        ];
    }


}
