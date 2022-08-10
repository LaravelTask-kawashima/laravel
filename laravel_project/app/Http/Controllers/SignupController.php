<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupStoreRequest;
use App\Models\User;

class SignupController extends Controller
{
    public function index()
    {
        return view("signup");
    }

    public function store(SignupStoreRequest $data)
    {
        User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => bcrypt($data["password"]),
        ]);
        return redirect("home");
    }
}
