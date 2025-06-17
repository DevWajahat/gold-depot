<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCheckoutRequest;
use App\Models\Coupon;

use Illuminate\Support\Facades\DB;

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

        $cart = session()->get('cart');

        if ($couponCode) {
            $couponCode->update([
                'remaining' => $couponCode->remaining - 1,
            ]);
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
        }


        $order = $user->orders()->create([
            'sub_total' => $cart['sub_total'],
            'shipping' => $cart['shipping'],
            'total_amount' => $cart['total'],
            'full_name' => $request->full_name,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'phone' => $request->phone
        ]);


        foreach (session()->get('cart')["items"] as $cart) {
            $order->products()->attach(
                $cart['id'],
                [
                    'quantity' => $cart['quantity'],
                    'price' => $cart['price'],
                    'product_name' => $cart['name'],
                    'category' => $cart['category'],
                    'total_price' => $cart["product_total"],
                ]
            );

            // Phir pivot ka instance access karne ke liye:
            $attachedProduct = $order->products()->where('product_id', $cart['id'])->first();

            foreach ($cart["variants"] as $attr => $variant) {
                DB::table('order_product_variant')->insert([
                    'order_product_id' => $attachedProduct->pivot->id,
                    'attribute' => $attr,
                    'variant' => $variant,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        session()->forget('cart');

        return redirect()->route('checkout.confirm');
    }

    public function confirm()
    {
        return view('screens.web.checkout.confirmation');
    }
}
