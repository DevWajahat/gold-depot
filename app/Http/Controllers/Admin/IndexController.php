<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
class IndexController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        $users = User::all();
        $products = Product::where('status','available')->get();

        $revenue = $orders->sum('total_amount');

        return view('screens.admin.index',get_defined_vars())  ;
    }
}
