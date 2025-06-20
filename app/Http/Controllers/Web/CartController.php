<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CartController extends Controller
{
    public function index()
    {

        // dd(session()->get('cart'));

        return view('screens.web.cart.index', get_defined_vars());
    }

    public function update(Request $request, $id)
    {

        $cart = session()->get('cart');
        if (isset($cart['items'][$id])) {
            if (isset($cart['items'][$id]['variants'])) {
                $cart['items'][$id]['quantity'] = $request['value'];

                $cart['items'][$id]['product_total'] = intval($request['value']) * floatval($cart['items'][$id]['sumprice']);
                // dd($cart['items'][$id]['product_total']);
                session()->put('cart', $cart);
                $calculated = $this->calculate();
            } else {

                $cart['items'][$id]['quantity'] = $request['value'];
                $cart['items'][$id]['product_total'] = intval($request['value']) * floatval($cart['items'][$id]['price']);
                session()->put('cart', $cart);
                $calculated = $this->calculate();
            }

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
            $subTotal += (float) $cartItem['product_total'];
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

        $cart = session()->get('cart');

        $itemtotal = $product->price * $request->quantity;

        if ($request->has('variants')) {
            $cartKey = $id . '-' . implode('-', $request->variants);

            if (isset($cart['items'][$cartKey])) {
                $cart['items'][$cartKey]['quantity'] = $request->quantity;


                $cart['items'][$cartKey]['product_total'] = $cart['items'][$cartKey]['sumprice'] * $request['quantity'];

                // dd($cart['items'][$cartKey]['sumprice']);
                $this->setVariants($request->variants, $cart, $cartKey, $id);

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

            ];



            $this->setVariants($request->variants, $cart, $cartKey, $id);

            foreach ($cart["items"] as $key => $item) {
                $sumprice = 0;

                if (isset($item["variants"]) && is_array($item["variants"])) {
                    foreach ($item["variants"] as $variant) {
                        $price = Arr::get($variant, 'price', 0);
                        $sumprice += $price;
                    }
                }

                $cart["items"][$key]['sumprice'] = floatval($sumprice) + floatval($cart["items"][$key]['price']);
                // dd($cart["items"][$key]['sumprice'],$cart);

                 $cart["items"][$key]['product_total'] = floatval($cart["items"][$key]['sumprice']) * floatval($cart["items"][$key]['quantity']);
                // dd($cart["items"][$key]['product_total'],$cart);
            }
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


        $cart =  session()->put('cart', $cart);

        $this->calculate();
        return back()->with('message', 'Product added to cart Successfully');
    }

    public function setVariants($ids, &$cart, $cartKey, $id)
    {
        $cart['items'][$cartKey]['variants'] = [];

        $product = Product::find($id);
        foreach ($ids as $varId) {
            $variant =  $product->variants->find($varId);
            $cart['items'][$cartKey]['variants'] +=
                [
                    $variant->attribute->name => [$variant->name, 'price' => $variant->pivot->price]
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

        $cart = session()->get('cart');
        $productId = explode("-", $request->id);
        $productId = $productId[0];

        $product = Product::find($productId);

        $variant = $product->variants->where('name', $request->variant)->first();

        $price = $variant->pivot->price;


        $cartVariants = $cart["items"][$request->id]["variants"];
        $cartPrice = $cart["items"][$request->id]["variants"];

        $cartVariants[$request->attribute][0]   = $request->variant;
        $cartPrice[$request->attribute]['price']   = $price;
        $cart["items"][$request->id]["variants"] = $cartVariants;

        $cart["items"][$request->id]["variants"][$request->attribute]['price'] = $price;

        $cart["items"][$request->id]["sumprice"] = 0;

        $sumprice = 0;




        foreach ($cart["items"][$request->id]["variants"] as $variant) {
            $price = Arr::get($variant, 'price', 0);
            $sumprice += $price;
        }

        // dd($sumprice);


        $cart["items"][$request->id]['sumprice'] = floatval($sumprice) + floatval($cart['items'][$request->id]['price']);
        $sumprice = $cart["items"][$request->id]['sumprice'] ;

        // dd($sumprice);

        $cart["items"][$request->id]['product_total'] = intval($cart["items"][$request->id]['quantity']) * floatval($cart["items"][$request->id]['sumprice']);
        // dd($cart['items'][$request->id]['sumprice']);
        session()->put('cart', $cart);

        $calculated =  $this->calculate();

       $cart = session()->get('cart', $cart);

        return response()->json([
            'message' => 'done',
            'cart' => $cart["items"],
            'sumprice' => $cart['items'][$request->id]['sumprice'],
            'product_total' =>   $cart["items"][$request->id]['product_total'],
            'sub_total' => $cart["sub_total"],
            'shipping' => $calculated["shipping"],
            'total' => $calculated["total"],
        ]);
    }
}
