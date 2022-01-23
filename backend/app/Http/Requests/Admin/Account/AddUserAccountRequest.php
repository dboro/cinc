<?php


namespace App\Http\Requests\Admin\Account;


use App\Http\Dto\Admin\Account\AddUserAccountDto;
use App\Models\Admin\Account;
use App\Models\User;
use Dboro\LaravelStart\Dto\Dto;
use Dboro\LaravelStart\Requests\StartRequest;

class AddUserAccountRequest extends StartRequest
{
    protected ?string $modelClass = Account::class;

    protected array $permissions = [
        //'admin.account.show'
    ];

    public function rules()
    {
        return [
            'email' => ['required', 'email']
        ];
    }

    protected function initDto()
    {
        $email = $this->get('email');

        $this->dto = new AddUserAccountDto(
            $this->route('id'),
            User::query()->where('email', $email),
            $email
        );
    }
}
