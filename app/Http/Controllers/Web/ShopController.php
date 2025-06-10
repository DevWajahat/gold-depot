<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class ShopController extends Controller
{
    public function index()
    {
        $Products = Product::where('status', 'available')->paginate(2);

        return view('screens.web.shop.index', get_defined_vars());
    }

    public function category($id)
    {
        $category = Category::find($id);

        return view('screens.web.shop.cateogory', get_defined_vars());
    }
    public function details($id)
    {
        $product = Product::with('productImages', 'category', 'reviews')->find($id);

        // $user = User::find(auth()->user()->id);
        if(auth()->user()){
            $userOrders =  auth()->user()->orders()->whereHas('products', function ($queryproduct) use ($id) {
            // dd($queryproduct);
            $queryproduct->where('product_id', $id);
        })->count();

        }




        return view('screens.web.shop.detail', get_defined_vars());
    }
}
