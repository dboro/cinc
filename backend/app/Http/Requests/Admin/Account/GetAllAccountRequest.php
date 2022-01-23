<?php


namespace App\Http\Requests\Admin\Account;


use Dboro\LaravelStart\Requests\GetAllRequest;


class GetAllAccountRequest extends GetAllRequest
{
    protected array $permissions = [
        //'admin.account.get-all'
    ];
}
