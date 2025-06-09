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
        dd(session()->get('cart'));
        $subTotal = 0;
        if (session()->has('cart')) {
            foreach (session()->get('cart') as $id => $cart) {

                $subTotal += $cart['price'] * $cart['quantity'];
            }
        }
        $shipping = $subTotal > 199 ? "FREE SHIPPING" : 9.95;

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

        $itemtotal = $product->price * $request->quantity;

        $cart = session()->get('cart');

        if (isset($cart['items'][$id])) {
            $cart['items'][$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        $cart['items'][$id] = [
            'category' => $product->category->name,
            'name' => $product->name,
            'image' => $product->image,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'product_total' =>  $itemtotal
        ];
        $subTotal = 0;
        foreach ($cart['items'] as $cartItem) {
            $productTotal = $cartItem['product_total'];
            $productTotal = (int)$productTotal;
            $subTotal += $productTotal;
        }
        $shipping = $subTotal > 199 ? 0 : 9.95;
        $total = $shipping + $subTotal;
        $cart['shippping'] = $shipping;
        $cart['total'] = $total;
        $cart['sub_total'] = $subTotal;
        $cart =  session()->put('cart', $cart);
        return back()->with('message', 'Product added to cart Successfully');
    }

    public function destroy($id)
    {
        if ($id) {
            $cart = session()->get('cart');
            if (isset($cart[$id])) {
                unset($cart[$id]);
                // session()->put('cart', $cart);
            }
        }
        return back()->with('message', 'product Removed From Cart Successfully');
    }
    public function flush()
    {
        session()->flush();
        return back();
    }
}
