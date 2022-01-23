<?php


namespace App\Actions\Admin\Account;


use App\Http\Dto\Admin\Account\AddUserAccountDto;
use App\Http\Dto\Admin\Account\CheckUserAccountDto;
use App\Http\Dto\Admin\Account\GetUsersAccountDto;
use App\Repositories\Admin\AccountRepository;
use Dboro\LaravelStart\Actions\DestroyAction;
use Dboro\LaravelStart\Actions\FindAction;
use Dboro\LaravelStart\Actions\GetAllAction;
use Dboro\LaravelStart\Actions\StartActions;
use Dboro\LaravelStart\Actions\StoreAction;
use Dboro\LaravelStart\Actions\UpdateAction;
use Dboro\LaravelStart\Dto\DestroyDto;
use Dboro\LaravelStart\Dto\ShowDto;
use Dboro\LaravelStart\Dto\GetAllDto;
use Dboro\LaravelStart\Dto\StoreDto;
use Dboro\LaravelStart\Dto\UpdateDto;
use Dboro\LaravelStart\Repositories\Repository;

class AccountActions extends StartActions
{
    public function getUsers(GetUsersAccountDto $dto)
    {

    }

    public function addUser(AddUserAccountDto $dto)
    {

    }

    public function checkUser(CheckUserAccountDto $dto)
    {

    }
}
