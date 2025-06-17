<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // dd(session('cart'));
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
            $subTotal += (int) $cartItem['product_total'];
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

        $itemtotal = $product->price * $request->quantity;
        $cart = session()->get('cart');

        if ($request->has('variants')) {
            $cartKey = $id . '-' . implode('-', $request->variants);

            if (isset($cart['items'][$cartKey])) {
                $cart['items'][$id]['quantity'] = $request->quantity;
                $cart['items'][$id]['variants'] = [];
                $this->setVariants($request->variants, $cart, $id);

                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Product added to cart successfully!');
            }


            $cart['items'][$cartKey] = [
                'id' => $product->id,
                'category' => $product->category->name,
                'name' => $product->name,
                'image' => $product->image, 
                'price' => $product->price,
                'quantity' => $request->quantity,
                'product_total' =>  $itemtotal,

            ];
            $this->setVariants($request->variants, $cart, $cartKey);
        } else {
            if (isset($cart['items'][$id])) {
                $cart['items'][$id]['quantity'] = $request->quantity;
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Product added to cart successfully!');
            }

            $cart['items'][$id] = [
                'id' => $product->id,
                'category' => $product->category->name,
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'product_total' =>  $itemtotal,

            ];
        }


        // if (isset($cart['items'][$cartKey])) {
        //     $cart['items'][$id]['quantity'] = $request->quantity;
        //     $cart['items'][$id]['variants'] = [];
        //     $this->setVariants($request->variants, $cart, $id);

        //     session()->put('cart', $cart);
        //     return redirect()->back()->with('success', 'Product added to cart successfully!');
        // }


        $cart =  session()->put('cart', $cart);

        $this->calculate();
        return back()->with('message', 'Product added to cart Successfully');
    }

    public function setVariants($ids, &$cart, $cartKey)
    {
        $cart['items'][$cartKey]['variants'] = [];
        foreach ($ids as $varId) {
            $variant = Variant::find($varId);
            $cart['items'][$cartKey]['variants'] +=
                [
                    $variant->attribute->name => $variant->name
                ];
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $cart = session()->get('cart');
            if (isset($cart['items'][$id])) {

                unset($cart['items'][$id]);
                if (count(session()->get('cart')["items"]) == 0) {
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

    public function updateVariant(Request $request)
    {

        // dd($request->all());

        $cart = session()->get('cart');


        $cartVariants = $cart["items"][$request->id]["variants"];

        $cartVariants[$request->attribute]   = $request->variant;
        $cart["items"][$request->id]["variants"] = $cartVariants;

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'done',
            'cart' => $cart["items"]
        ]);
    }
}
