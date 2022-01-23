<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = User::where('email', $request->get('email'))->first();

        if (!$user) {
            return \response()->json([
                'errors' => ['email' => [__('Пользователь не зарегестрирован.')]]
            ], 422);
        }

        if (!Hash::check($request->get('password'), $user->password)) {
            return response()->json([
                'errors' => ['password' => [__('Неверный пароль.')]]
            ], 422);
        }

        Auth::login($user, true);

        return response()->json([
            'data' => 'ok'
        ]);

    }

    public function logout()
    {
        Auth::guard('web')->logout();

        return response()->json([
            'data' => 'ok'
        ]);
    }
}
