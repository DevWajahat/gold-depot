<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;

use App\Models\Product;


class ShopController extends Controller
{
    public function index()
    {
        $Products = Product::paginate(2);

        return view('screens.web.shop.index',get_defined_vars());
    }

    public function category($id)
    {
        $category = Category::find($id);

        return view('screens.web.shop.cateogory', get_defined_vars());
    }
    public function details($id)
    {
        $product = Product::find($id);


        


        return view('screens.web.shop.detail', get_defined_vars());
    }
}
