<?php


namespace App\Repositories\Admin;


use App\Models\Admin\Account;
use Spatie\QueryBuilder\AllowedSort;

class AccountRepository extends AdminRepository
{
    protected ?string $defaultSort = '-id';

    protected ?array  $allowSorts = ['name', 'slug', 'product_id'];

    protected ?array $allowFields = ['id', 'name', 'slug', 'product_id'];

    protected ?array $allowIncludes = ['product', 'users'];

    public function getIncludesRepositories() : array
    {
        return [
            'users' => UserRepository::class,
            'product' => ProductRepository::class
        ];
    }

    protected function model() : string
    {
        return Account::class;
    }
}
