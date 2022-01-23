<?php


namespace App\Http\Controllers\Admin;


use App\Actions\Admin\User\UserActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\DestroyUserRequest;
use App\Http\Requests\Admin\User\GetAllUserRequest;
use App\Http\Requests\Admin\User\ShowUserRequest;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Repositories\Admin\UserRepository;
use Dboro\LaravelStart\Requests\ShowRequest;

class UserController extends Controller
{
    protected UserActions $actions;

    public function __construct()
    {
        $this->actions = new UserActions(new UserRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetAllUserRequest $request)
    {
        return $this->actions->getAll($request->getDto());
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
    public function store(StoreUserRequest $request)
    {
        return $this->actions->store($request->getDto());
    }

    /**
     * Display the specified resource.
     *
     * @param ShowRequest $request
     * @return \Illuminate\Http\Response
     */
    public function show(ShowUserRequest $request)
    {
        return $this->actions->find($request->getDto());
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
    public function update(UpdateUserRequest $request)
    {
        return $this->actions->update($request->getDto());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyUserRequest $request)
    {
        return $this->actions->destroy($request->getDto());
    }
}
