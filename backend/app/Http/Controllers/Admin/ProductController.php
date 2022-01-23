<?php


namespace App\Http\Controllers\Admin;


use App\Actions\Admin\Product\ProductActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\DestroyProductRequest;
use App\Http\Requests\Admin\Product\GetAllProductRequest;
use App\Http\Requests\Admin\Product\ShowProductRequest;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Repositories\Admin\ProductRepository;
use Dboro\LaravelStart\Requests\ShowRequest;
use Dboro\LaravelStart\Resources\StartResource;

class ProductController extends Controller
{
    protected ProductActions $actions;

    public function __construct()
    {
        $this->actions = new ProductActions(new ProductRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetAllProductRequest $request)
    {
        $products = $this->actions->getAll($request->getDto());

        return [
            'data' => StartResource::collection($products)
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        return $this->actions->store($request->getDto());
    }

    /**
     * Display the specified resource.
     *
     * @param ShowRequest $request
     * @return \Illuminate\Http\Response
     */
    public function show(ShowProductRequest $request)
    {
        $product = $this->actions->find($request->getDto());

        return [
            'data' => new StartResource($product)
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request)
    {
        return $this->actions->update($request->getDto());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyProductRequest $request)
    {
        return $this->actions->destroy($request->getDto());
    }
}
