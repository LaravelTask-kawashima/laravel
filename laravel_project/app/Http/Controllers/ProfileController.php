<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule as ValidationRule;

class ProfileController extends Controller
{
    

    public function index()
    {
        $users = User::all();
        return view("index",compact("users"));
    }

    public function edit(User $user){
        $this->authorize('update', $user);
        return view('profile.edit', compact('user'));
    }

    public function update(User $user , Request $request)
    {
        $this->authorize('update', $user);

        $inputs = $request->validate([
            "name" => ["required","string","max:255"],
            'email' => ['required', 'string', 'email', 'max:255', ValidationRule::unique('users')->ignore($user->id)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            "password_confirmation" => ["required" , "same:password"]
        ]);

        $inputs["password"] =Hash::make($inputs["password"]);

        $user->update($inputs);
        return back()->with("message","更新完了しました。");
    }
}
