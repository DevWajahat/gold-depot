<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCheckoutRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $subTotal = 0;
        if (session()->has('cart')) {
            foreach (session()->get('cart') as $id => $cart) {

                $subTotal += $cart['price'] * $cart['quantity'];
            }
        }
        $shipping = 9.95;
        $total = $subTotal + $shipping;

        if ($subTotal > 199) {
            $shipping = "FREE SHIPPING";
        }



        return view('screens.web.checkout.index', get_defined_vars());
    }

    public function store(StoreCheckoutRequest $request)
    {
        $user = auth()->user();

        // dd($request->coupon_value);

        $couponCode = Coupon::where('coupon_code', $request->coupon_value)->first();

        if ($couponCode) {
            $couponCode->update([
                'remaining' => $couponCode->remaining - 1,
            ]);
        }


        $order = $user->orders()->create([
            'sub_total' => $request->sub_total,
            'shipping' => $request->shipping,
            'total_amount' => $request->total,
            'full_name' => $request->full_name,
            'city' => $request->city,
            'country' => $request->country,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'phone' => $request->phone
        ]);

        foreach (session()->get('cart') as $id => $cart) {

            // $couponCode

            $order->products()->attach([
                $id => [
                    'quantity' => $cart['quantity'],
                    'price' => $cart['price'],
                    'product_name' => $cart['name'],
                    'category' => $cart['category'],
                    'total_price' => $cart['price'] * $cart['quantity']
                ]
            ]);
        }

        session()->forget('cart');

        return redirect()->route('checkout.confirm');
    }

    public function confirm()
    {
        return view('screens.web.checkout.confirmation');
    }
}
