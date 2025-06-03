<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        //  dd(session()->get('cart'));


        $subTotal = 0;
        if (session()->has('cart')) {
            foreach (session()->get('cart') as $id => $cart) {

                $subTotal += $cart['price'] * $cart['quantity'];
            }
        }
        $shipping = 9.95;

        if ($subTotal > 199) {

            $shipping = "FREE SHIPPING";
            return view('screens.web.cart.index', get_defined_vars());
        }


        return view('screens.web.cart.index', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {

            $subTotal = 0;

            $cart[$id]['quantity'] = $request['value'];
            // $cart[$id]['total']
            session()->put('cart', $cart);
            $total = $cart[$id]['quantity'] * $cart[$id]['price'];


            if (session()->has('cart')) {
                foreach (session()->get('cart') as $id => $cart) {

                    $subTotal += $cart['price'] * $cart['quantity'];
                }
            }
            $shipping = 9.95;

            if ($subTotal > 199) {

                return response()->json([
                    'message' => 'Updated Successfully',
                    'itemTotal' => $total,
                    'subTotal' => $subTotal,
                    'shipping' => 'FREE SHIPPING',
                    'total' => $subTotal
                ]);
            }
            return response()->json([
                'message' => 'Updated Successfully',
                'itemTotal' => $total,
                'subTotal' => $subTotal,
                'shipping' => $shipping,
                'total' => $shipping + $subTotal
            ]);
        }
    }

    public function store(Request $request, $id)
    {

        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        $total = $product->price * $request->quantity;

        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        $cart[$id] = [
            'category' => $product->category->name,
            'name' => $product->name,
            'image' => $product->image,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'product_total' =>  $total
        ];

        session()->put('cart', $cart);

        // dd(session()->get('cart'));


        return back()->with('message', 'Product added to cart Successfully');
    }
    public function destroy($id)
    {
        if ($id) {
            $cart = session()->get('cart');
            if (isset($cart[$id])) {
                unset($cart[$id]);

                session()->put('cart', $cart);
            }
        }

        return back()->with('message', 'product Removed From Cart Successfully');
    }
}
