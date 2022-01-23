<?php


namespace App\Actions\Admin\Account;


use App\Http\Dto\Admin\Account\GetUsersAccountDto;
use App\Repositories\Admin\AccountRepository;
use Dboro\LaravelStart\Actions\StartAction;

/**
 * Class GetUsersAccountAction
 * @package App\Actions\Admin\Account
 *
 * @property AccountRepository $repository
 */
class GetUsersAccountAction extends StartAction
{
    /**
     * @param GetUsersAccountDto $dto
     */
    public function run($dto)
    {
        $accountId = $dto->getId();
        $this->repository->getUsersByAccountId($accountId);


    }
}
