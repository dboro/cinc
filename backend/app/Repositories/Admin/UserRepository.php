<?php


namespace App\Repositories\Admin;


use App\Models\Admin\User;

class UserRepository extends AdminRepository
{
    protected ?string $defaultSort = '-id';

    protected ?array $allowFields = ['id', 'name'];

    protected ?array $allowIncludes = ['accounts', 'users'];

    public function getIncludesRepositories() : array
    {
        return [
            'accounts' => AccountRepository::class,
            'users' => UserRepository::class,
        ];
    }

    protected function model() : string
    {
        return User::class;
    }
}
