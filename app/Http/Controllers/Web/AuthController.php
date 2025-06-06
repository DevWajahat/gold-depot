<?php

namespace App\Http\Controllers\Web;

use App\Events\PasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\ForgotPasswordViewRequst;
use App\Http\Requests\PostUserLoginRequest;
use App\Http\Requests\StoreResetPasswordRequest;
use App\Http\Requests\StoreUserRegisterRequest;
use App\Mail\ResetPassword;
use App\Models\PasswordResetToken;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.web.login');
    }

    public function login(PostUserLoginRequest $request)
    {

        // dd($request->email);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

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
            // 'role' => 'customer',
            'password' => $request->password,
            'phone' => $request->phone
        ]);


        // if ($user->role == 'customer') {
            Auth::login($user);
            return redirect()->route('index');
        // }
    }

    public function forgotPasswordView()
    {
        return view('auth.web.forgetpassword');
    }
    public function forgotPasswordPost(ForgotPasswordViewRequst $request)
    {
        $token = Str::random();

        $passwordInstance = PasswordResetToken::updateOrCreate(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        // Mail::to($passwordInstance->email)->send(new ResetPassword($passwordInstance));

        event(new PasswordReset($passwordInstance));

        return back()->with('message', 'We have e-mailed your Password Reset Link!');
    }

    public function resetPasswordView(Request $request, $token)
    {
        $instance = PasswordResetToken::where('token', $token)->first();

        if (!$instance) {
            return abort('404');
        }

        return view('auth.web.resetpassword', get_defined_vars());
    }

    public function resetPassword(StoreResetPasswordRequest $request)
    {

        // dd($request->token);

        $updatePassword = PasswordResetToken::where('email', $request->email)->where('token', $request->token)->first();

        if (!$updatePassword) {
            return back()->withInput();
        }

        User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        PasswordResetToken::find($request->email)->delete();

        return redirect()->route('login')->with('successfull-message', 'Your Password has been changed');
    }
}
