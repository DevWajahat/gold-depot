<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('screens.web.cart.index', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart');
        if (isset($cart['items'][$id])) {
            $cart['items'][$id]['quantity'] = $request['value'];
            $cart['items'][$id]['product_total'] = intval($request['value']) * floatval($cart['items'][$id]['price']);
            session()->put('cart', $cart);
            $calculated = $this->calculate();

            return response()->json([
                "message" => "Run",
                "itemTotal" => $cart['items'][$id]['product_total'],
                "subTotal" =>  $calculated['subTotal'],
                "shipping" => $calculated['shipping'],
                "total" => $calculated['total']
            ]);
        }
    }
    public function calculate()
    {
        $cart = session()->get('cart', []);
        $subTotal = 0;
        foreach ($cart['items'] as $cartItem) {
            $productTotal = $cartItem['product_total'];
            $productTotal = (int)$productTotal;
            $subTotal += $productTotal;
        }
        $shipping = $subTotal > 199 ? 0 : 9.95;
        $total = $shipping + $subTotal;
        $cart['shipping'] = $shipping;
        $cart['total'] = $total;
        $cart['sub_total'] = $subTotal;

        session()->put('cart', $cart);
        return [
            "subTotal" =>  $cart['sub_total'],
            "shipping" => $cart['shipping'],
            "total" => $cart['total']
        ];
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
        $cart =  session()->put('cart', $cart);
        $this->calculate();
        return back()->with('message', 'Product added to cart Successfully');
    }

    public function destroy($id)
    {
        if ($id) {
            $cart = session()->get('cart');
            if (isset($cart['items'][$id])) {
                // dd($cart['items'][$id], $cart, $id);
                unset($cart['items'][$id]);
                if(count(session()->get('cart')["items"]) == 0 ){
                    $cart['total'] = 0;
                    $cart['sub_total'] = 0;
                    $cart['shipping'] = 0;
                }
            }
        }
        $this->calculate();
        session()->put('cart', $cart);
        return back()->with('message', 'product Removed From Cart Successfully');
    }

    public function flush()
    {
        session()->forget('cart');
        return back();
    }
}
