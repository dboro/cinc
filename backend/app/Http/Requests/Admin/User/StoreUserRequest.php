<?php

namespace App\Http\Requests\Admin\User;


use Dboro\LaravelStart\Requests\StoreRequest;

class StoreUserRequest extends StoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:50', 'unique:users'],
            'slug' => ['required', 'min:3', 'max:50', 'alpha_dash', 'unique:users'],
            'description' => ['max:255']
        ];
    }


}
