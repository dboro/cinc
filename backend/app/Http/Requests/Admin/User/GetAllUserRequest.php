<?php


namespace App\Http\Requests\Admin\User;


use Dboro\LaravelStart\Requests\GetAllRequest;


class GetAllUserRequest extends GetAllRequest
{
    protected array $permissions = [
        //'admin.user.get-all'
    ];
}
