<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

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
        if(!$category){
            return abort('404');
        }

        return view('screens.web.shop.cateogory', get_defined_vars());
    }
    public function details($id)
    {
        $product = Product::with('productImages', 'category', 'reviews')->find($id);




        if(auth()->user()){
            $userOrders =  auth()->user()->orders()->whereHas('products', function ($queryproduct) use ($id) {
            $queryproduct->where('product_id', $id);
        })->count();

        }




        return view('screens.web.shop.detail', get_defined_vars());
    }
}
