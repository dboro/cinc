<?php

namespace Database\Seeders;

use App\Models\Admin\Account;
use App\Models\Admin\Product;
use App\Models\User;
use Database\Factories\Admin\UserFactory;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = $this->getProducts();

        foreach ($products as $product) {
            Product::factory()
                ->has(
                    Account::factory()
                        ->has(User::factory()
                        ->count(rand(1,10))
                    )
                    ->count(500)
                )
                ->state([
                    'name' => $product['name'],
                    'slug' => $product['slug']
                ])
                ->create();
        }
    }

    protected function getProducts() : array
    {
        return [
            [
                'name' => 'CRM',
                'slug' => 'crm',
            ],
            [
                'name' => 'To Do',
                'slug' => 'todo'
            ]
        ];
    }
}
