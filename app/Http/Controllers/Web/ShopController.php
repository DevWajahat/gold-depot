<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        return view('screens.web.shop.index');
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
