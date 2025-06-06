<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {

        $orders = Order::all();

        return view('screens.admin.orders.index', get_defined_vars());
    }
    public function details($id)
    {
        $order = Order::find($id);

        return view('screens.admin.orders.details', get_defined_vars());
    }

    public function updateStatus(Request $request)
    {
        $order = Order::find($request->order);

        $order->update([
            'status' => $request->status
        ]);

        return response()->json([
            'status' => $order->status,
            'message' => "Done"
        ]);
    }
}
