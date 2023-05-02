<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;


class RegisterController extends Controller
{
    

    public function index()
    {
        return view("auth.pre_register");
    }

    /**
     * 新規ユーザーの仮登録
     * @param  RegisterRequest $request
     * @return \Illuminate\Http\Response
     */

    public function register(RegisterRequest $request)
    {
        $email = $request["email"];
        Mail::send(new RegisterMail($email));
        return view("auth.mail_verify");
    }
}
