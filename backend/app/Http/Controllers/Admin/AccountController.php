<?php


namespace App\Http\Controllers\Admin;


use App\Actions\Admin\Account\AccountActions;
use App\Http\Controllers\Controller;
use App\Http\Dto\Admin\Account\CheckUserAccountDto;
use App\Http\Requests\Admin\Account\CheckUserAccountRequest;
use App\Http\Requests\Admin\Account\DestroyAccountRequest;
use App\Http\Requests\Admin\Account\GetAllAccountRequest;
use App\Http\Requests\Admin\Account\ShowAccountRequest;
use App\Http\Requests\Admin\Account\StoreAccountRequest;
use App\Http\Requests\Admin\Account\UpdateAccountRequest;
use App\Models\Admin\Account;
use App\Repositories\Admin\AccountRepository;
use Dboro\LaravelStart\Requests\ShowRequest;
use Dboro\LaravelStart\Resources\StartResource;

class AccountController extends Controller
{
    protected AccountActions $actions;

    public function __construct()
    {
        $this->actions = new AccountActions(new AccountRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetAllAccountRequest $request)
    {
        $accounts = $this->actions->getAll($request->getDto());

        return [
            'data' => StartResource::collection($accounts)
        ];
    }

    public function count()
    {
        return [
            'data' => Account::query()->count()
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
    public function store(StoreAccountRequest $request)
    {
        return $this->actions->store($request->getDto());
    }

    /**
     * Display the specified resource.
     *
     * @param ShowRequest $request
     * @return \Illuminate\Http\Response
     */
    public function show(ShowAccountRequest $request)
    {
        $account = $this->actions->find($request->getDto());

        return [
            'data' => new StartResource($account)
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
    public function update(UpdateAccountRequest $request)
    {
        return $this->actions->update($request->getDto());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyAccountRequest $request)
    {
        return $this->actions->destroy($request->getDto());
    }

    public function checkUser(CheckUserAccountRequest $request)
    {
        return $this->actions->checkUser();
    }
}
