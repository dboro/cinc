<?php

namespace App\Http\Requests\Admin\Account;


use App\Models\Admin\Account;
use Dboro\LaravelStart\Requests\DestroyRequest;

class DestroyAccountRequest extends DestroyRequest
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

        ];
    }


}
