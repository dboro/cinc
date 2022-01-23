<?php


namespace App\Http\Requests\Admin\Product;


use Dboro\LaravelStart\Requests\GetAllRequest;


class GetAllProductRequest extends GetAllRequest
{
    protected array $permissions = [
        //'admin.product.get-all'
    ];
}
