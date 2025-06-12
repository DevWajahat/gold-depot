<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {

        $coupons = Coupon::all();

        return view('screens.admin.coupon.index', get_defined_vars());
    }

    public function create()
    {
        return view('screens.admin.coupon.create');
    }
    public function store(StoreCouponRequest $request)
    {
        $coupon = Coupon::create([
            'coupon_code' => $request->coupon_code,
            'type' => $request->type,
            'discount' => $request->discount,
            'max_usage' => $request->max_usage,
            'remaining' => $request->max_usage,
            'expiry' => $request->expiry,
            'status' => $request->status
        ]);


        return back()->with('message', 'Coupon Added Successfully');
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);



        return view('screens.admin.coupon.edit', get_defined_vars());
    }

    public function update(UpdateCouponRequest $request, $id)
    {

        $coupon = Coupon::find($id);

        $coupon->update([
            'coupon_code' => $request->coupon_code,
            'type' => $request->type,
            'discount' => $request->discount,
            'max_usage' => $request->max_usage,
            'remaining' => $request->max_usage,
            'expiry' => $request->expiry,
            'status' => $request->status
        ]);

        return back()->with('message', 'Coupon Updated Successfully');
    }

    public function destroy($id)
    {

        Coupon::find($id)->delete();

        return back()->with('message', 'Coupon Deleted Successfully');
    }

    public function updateStatus(Request $request)
    {

        $coupon = Coupon::find($request->coupon);

        $coupon->update([
            'status' => $request->status
        ]);

        return response()->json([
            'message' => "Coupon Deleted Successfully. "
        ]);
    }

}
