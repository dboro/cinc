<?php


namespace App\Repositories\Admin;


use App\Models\Admin\Product;

class ProductRepository extends AdminRepository
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

    public function getAll() :array
    {
        return $this->query()->where('id', '!=', Product::ADMINPANEL)->get()->all();
    }

    protected function model() : string
    {
        return Product::class;
    }
}
