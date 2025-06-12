<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostUserLoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.admin.login');
    }
    public function login(PostUserLoginRequest $request) {


        if(Auth::attempt(['email' => $request->email, 'password'=> $request->password]) ){

            return redirect()->route('admin.index')->with('message','login Successfully');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records'
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        return back();
    }
}
