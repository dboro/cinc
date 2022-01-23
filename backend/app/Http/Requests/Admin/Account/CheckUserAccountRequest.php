<?php


namespace App\Http\Requests\Admin\Account;


use App\Http\Dto\Admin\Account\CheckUserAccountDto;
use App\Models\Admin\Account;
use Dboro\LaravelStart\Requests\StartRequest;

class CheckUserAccountRequest extends StartRequest
{
    protected ?string $modelClass = Account::class;

    protected function initDto()
    {
        $this->dto = new CheckUserAccountDto($this->model, $this->request->get('email'));
    }
}
