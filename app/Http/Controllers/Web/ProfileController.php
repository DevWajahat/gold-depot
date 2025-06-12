<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserDetailRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('screens.web.profile.index', get_defined_vars());
    }

    public function edit()
    {
        $user = auth()->user();

        return view('screens.web.profile.edit', get_defined_vars());
    }

    public function update(UpdateUserDetailRequest $request)
    {
        $user = User::find(auth()->user()->id);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone
        ]);

        return redirect()->route('profile.index')->with('message', 'Your Profile Details are updated Successfully');
    }

    public function editPassword()
    {


        return view('screens.web.profile.edit-password');
    }

    public function updatePassword(UpdateUserPasswordRequest $request)
    {
        $user = User::find(auth()->user()->id);

        // dd($request->new_password);

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);


        return redirect()->route('profile.index')->with('message', 'Password Updated Successfully');
    }

    public function orders()
    {
        $user = User::find(auth()->user()->id);

        return view('screens.web.profile.orders', get_defined_vars());
    }

    public function orderDetail($id)
    {
        // $user = User::find(auth()->user()->id);
        $order = Order::find($id);
        $orderProducts = $order->products ;

        return view('screens.web.profile.order-details', get_defined_vars());
    }
}
