<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiRequest;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AgreementRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public $user;

    public function authorize()
    {
        $this->user = User::query()
            ->where('email', urldecode($this->route('email')))
            ->whereNotNull('agreement_token')
            ->first();

        if ($this->user && Hash::check($this->route('token'), $this->user->agreement_token)) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                Rule::unique('users')->ignore($this->user->id),
            ],
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'password' => 'required|min:8|confirmed'
        ];
    }
}
