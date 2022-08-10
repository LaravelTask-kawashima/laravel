<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    

    public function index()
    {
        return view("auth.pre_register");
    }

    public function register(Request $request)
    {
        $request->validate([
            "email" => ["required" , "email:filter", Rule::unique("users")],
        ]);
        $email = $request["email"];
        Mail::send(new RegisterMail($email));
        return view("auth.mail_verify");
    }
}
