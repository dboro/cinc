<?php


namespace App\Http\Requests\Admin\Product;


use App\Models\Admin\Product;
use Dboro\LaravelStart\Requests\ShowRequest;

class ShowProductRequest extends ShowRequest
{
    protected ?string $modelClass = Product::class;

    protected array $permissions = [
        //'admin.product.show'
    ];
}
