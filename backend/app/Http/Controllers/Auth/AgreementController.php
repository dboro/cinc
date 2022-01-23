<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\AgreementRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class AgreementController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('guest');
    }

    use RegistersUsers;

    /**
     * The user has been registered.
     *
     * @param  AgreementRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(AgreementRequest $request)
    {
        $item = $this->userRepository->updateWithProfile($request->user, $request->all());
        $item->setDefaultRoles();

        auth()->login($item);

        $item->sendEmailVerificationNotification();

        return response()->json([
            'data' => new UserResource($item)
        ]);
    }


}
