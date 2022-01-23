<?php

namespace App\Http\Requests\Admin\User;


use App\Models\Admin\User;
use Dboro\LaravelStart\Requests\DestroyRequest;

class DestroyUserRequest extends DestroyRequest
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

        ];
    }


}
