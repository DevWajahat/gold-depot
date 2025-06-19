<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index()
    {
        $Products = Product::where('status', 'available')->paginate(16);

        return view('screens.web.shop.index', get_defined_vars());
    }

    public function category($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return abort('404');
        }

        return view('screens.web.shop.cateogory', get_defined_vars());
    }
    public function details($id)
    {
        $product = Product::with('productImages', 'category', 'reviews')->find($id);

        $attributes = Attribute::all();
        $variants = Variant::all();


        if (auth()->user()) {
            $userOrders =  auth()->user()->orders()->whereHas('products', function ($queryproduct) use ($id) {
                $queryproduct->where('product_id', $id);
            })->count();
        }


        return view('screens.web.shop.detail', get_defined_vars());
    }

    public function calculatePrice(Request $request){


        $product = Product::find($request->product_id);


        $sumPrice = 0;
        foreach($request->dropdownValues as $dropdownvalue){
            // dd($product->variants->find($dropdownvalue),$product->variants,$dropdownvalue);
            $price = $product->variants->find($dropdownvalue)->pivot->price;
            $sumPrice += $price;
        }

        $calculatedPrice = $sumPrice + $product->price;

        return response()->json([
            'message' => 'Calculated Successfully',
            'calculatedPrice' => $calculatedPrice,
            'price' => $price
        ]);

    }




}
