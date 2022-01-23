<?php


namespace App\Http\Requests\Admin\User;


use App\Models\Admin\User;
use Dboro\LaravelStart\Requests\ShowRequest;

class ShowUserRequest extends ShowRequest
{
    protected ?string $modelClass = User::class;

    protected array $permissions = [
        //'admin.user.show'
    ];
}
