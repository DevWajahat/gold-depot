<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        $users = User::all();
        $products = Product::all();

        return view('screens.admin.index',get_defined_vars())  ;
    }
}
