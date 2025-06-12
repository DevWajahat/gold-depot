<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCheckoutRequest;
use App\Models\Coupon;

class CheckoutController extends Controller
{
    public function index()
    {

        if (empty(session()->get('cart')["items"])) {
            return redirect()->route('shop.index');
        }

        return view('screens.web.checkout.index', get_defined_vars());
    }

    public function store(StoreCheckoutRequest $request)
    {
        $user = auth()->user();
        $couponCode = Coupon::where('coupon_code', $request->coupon_value)->first();


        if ($couponCode) {
            $couponCode->update([
                'remaining' => $couponCode->remaining - 1,
            ]);
        }
        $cart = session()->get('cart');

        $order = $user->orders()->create([
            'sub_total' => $cart['sub_total'],
            'shipping' => $cart['shipping'],
            'total_amount' => $cart['total'],
            'full_name' => $request->full_name,
            'city' => $request->city,
            'coupon_code' => $couponCode->coupon_code,
            'discount' => $couponCode->discount,
            'state' => $request->state,
            'country' => $request->country,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'phone' => $request->phone
        ]);

        foreach (session()->get('cart')["items"] as $id => $cart) {
            // $couponCode

            $order->products()->attach([
                $id => [
                    'quantity' => $cart['quantity'],
                    'price' => $cart['price'],
                    'product_name' => $cart['name'],
                    'category' => $cart['category'],
                    'total_price' => $cart["product_total"]
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
