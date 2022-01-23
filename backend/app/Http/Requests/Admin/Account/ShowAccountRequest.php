<?php


namespace App\Http\Requests\Admin\Account;


use App\Models\Admin\Account;
use Dboro\LaravelStart\Requests\ShowRequest;

class ShowAccountRequest extends ShowRequest
{
    protected ?string $modelClass = Account::class;

    protected array $permissions = [
        //'admin.account.show'
    ];
}
