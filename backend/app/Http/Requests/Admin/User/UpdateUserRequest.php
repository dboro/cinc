<?php

namespace App\Http\Requests\Admin\User;


use App\Models\Admin\User;
use Dboro\LaravelStart\Requests\UpdateRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends UpdateRequest
{
    protected ?string $modelClass = User::class;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['sometimes', 'required', 'min:3', 'max:50',
                Rule::unique('users')->ignore($this->route('id'), 'id')],
            'slug' => ['sometimes', 'required', 'min:3', 'max:50', 'alpha_dash',
                Rule::unique('users')->ignore($this->route('id'), 'id')],
            'description' => ['max:255']
        ];
    }


}
