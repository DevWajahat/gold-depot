<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostUserLoginRequest;
use App\Http\Requests\StoreUserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.web.login');
    }

    public function login(PostUserLoginRequest $request) {

        // dd($request->email);
        if(Auth::attempt(['email' => $request->email, 'password'=> $request->password]) ){

            return redirect()->route('index');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records'
        ])->onlyInput('email');


    }

    public function registerView()
    {
        return view('auth.web.signup');
    }

    public function register(StoreUserRegisterRequest $request)
    {
        //  dd($request->firstname);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'role' => 'customer',
            'password' => $request->password,
            'phone' => $request->phone
        ]);


        if ($user->role == 'customer') {
            Auth::login($user);
            return redirect()->route('index');
        }

    }
}
