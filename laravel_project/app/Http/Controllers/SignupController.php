<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupStoreRequest;
use App\Models\User;
use Illuminate\Support\Str;

class SignupController extends Controller
{
    public function index()
    {
        return view("signup");
    }

    // public function store(SignupStoreRequest $data)
    // {
        
    //     $userData = User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => bcrypt($data['password']),
    //     ]);
        
    //     return response()->json([
    //         'access_token' => $userData["api_token"],
    //         'token_type' => 'Beaer'
    //     ]);
    // }
}
