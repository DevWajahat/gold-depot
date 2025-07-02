<?php

namespace App\Http\Controllers\Web;

use App\Events\OrderProducts;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCheckoutRequest;
use App\Models\Coupon;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\error;

class CheckoutController extends Controller
{
    public function index()
    {

        if (empty(session()->get('cart')["items"])) {
            return redirect()->route('shop.index');
        }

        $intent = auth()->user()->createSetupIntent();


        return view('screens.web.checkout.index', get_defined_vars());
    }

    function paymentIntent($paymentMethod)
    {
        $user = auth()->user();
        $cart = session()->get('cart');
        $user->createOrGetStripeCustomer();
        $payment = auth()->user()->pay(intval($cart['total']) * 100);

        $payment = $user->charge(floatval($cart['total']) * 100,$paymentMethod, [
            'return_url' => route('checkout.confirm'),

        ]);

        return $payment->client_secret;
    }
    
    public function store(StoreCheckoutRequest $request)
    {


        $user = auth()->user();
        $cart = session()->get('cart');
        $couponCode = Coupon::where('coupon_code', $request->coupon_value)->first();

        try{

            $this->paymentIntent($request->paymentMethodId);
        }catch(Exception $e){
            return error($e);
        }

        $this->checkAndUpdateProductQuantities($cart);

        if ($couponCode) {
            $this->applyCoupon($couponCode, $cart, $request, $user);
        } else {
            $this->createOrder($user, $cart, $request);
        }


        event(new OrderProducts($user->orders()->latest()->first()));

        $this->attachOrderProducts($user->orders()->latest()->first(), $cart);

        session()->forget('cart');

        return redirect()->route('checkout.confirm');
    }

    public function checkAndUpdateProductQuantities($cart)
    {
        foreach ($cart["items"] as $item) {
            $product = Product::find($item["id"]);

            if ($product->quantity < intval($item["quantity"])) {
                return back()->with('error', 'We only have ' . $product->name . ' ' . $product->quantity . ' in stocks.');
            }

            $product->update([
                'quantity' => $product->quantity - intval($item["quantity"])
            ]);
        }
    }

    public function applyCoupon($couponCode, $cart, $request, $user)
    {

        $couponCode->update([
            'remaining' => $couponCode->remaining - 1,
        ]);

        $user->orders()->create([
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

    public function createOrder($user, $cart, $request)
    {
        $user->orders()->create([
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
    }

    public function attachOrderProducts($order, $cart)
    {
        foreach ($cart["items"] as $item) {
            $order->products()->attach(
                $item['id'],
                [
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'product_name' => $item['name'],
                    'category' => $item['category'],
                    'total_price' => $item["product_total"],
                ]
            );

            $attachedProduct = $order->products()->where('product_id', $item['id'])->first();
            if (isset($item["variants"])) {
                foreach ($item["variants"] as $attr => $variant) {
                    DB::table('order_product_variant')->insert([
                        'order_product_id' => $attachedProduct->pivot->id,
                        'attribute' => $attr,
                        'variant' => $variant[0],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    public function confirm()
    {
        return view('screens.web.checkout.confirmation');
    }
}
