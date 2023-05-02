<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * ユーザー新規登録
     * @param  \Illuminate\Http\Request\AuthRegisterRequest $request
     * @return \Illuminate\Http\Response json
     */
    public function register(AuthRegisterRequest $validatedData)
    {
        $user = User::make($validatedData);
        $token = $user->createToken('auth_token')->plainTextToken;
        $json = [
            'user' => $user,
            'auth_token' => $token,
            'token_type' => 'Beaer'
        ];
        return response()->json( $json , Response::HTTP_OK);
    }

    /**
     * ログイン
     * @param  \Illuminate\Http\Request\AuthLoginRequest $request
     * @return \Illuminate\Http\Response json
     */
    public function login(AuthLoginRequest $request)
    {
        $credentials = $request->only('email' , 'password');
        
        if(!Auth::attempt($credentials)){
            return response()->json([
                'message' => __("message.auth.loginFailed")
            ],Response::HTTP_UNAUTHORIZED);
        }

        $user = User::where('email',$credentials['email'])->firstOrFail();
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;

        $json = [
            'message' => __('message.auth.loginSuccess'),
            'user' => $user,
            'token' => $token
        ];
        return response()->json($json,Response::HTTP_OK);
    }

    /**
     * ログアウト
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response json
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => __('message.auth.logOut'),
        ],Response::HTTP_OK);
    }
}
