<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\PostUserLoginRequest;
use App\Http\Requests\StoreAdminRegisterRequest;
use App\Models\User;

use Illuminate\Http\Request;
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


    // public function registerView()
    // {
    //     return view('auth.admin.register');
    // }
    // public function register(StoreAdminRegisterRequest $request)
    // {
    //     $user = User::create([
    //         'first_name' => $request->firstname,
    //         'last_name' => $request->lastname,
    //         'email' => $request->email,
    //         'role' => $request->role,
    //         'password' => $request->password,
    //         'phone' => $request->phone
    //     ]);

    //     if ($user->role == 'admin') {
    //         Auth::login($user);

    //         return redirect()->route('admin.index');
    //     }
    // }


    public function logout()
    {
        Auth::logout();
        return back();
    }
}
