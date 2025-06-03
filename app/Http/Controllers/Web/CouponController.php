<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function checkCoupon($couponCode)
    {


        $couponCode = Coupon::where('coupon_code', $couponCode)->first();

        $subTotal = 0;

        if (session()->has('cart') && count(session()->get('cart'))) {
            foreach (session()->get('cart') as $id => $cart) {

                $subTotal += $cart['price'] * $cart['quantity'];
            }


            if ($subTotal > 199) {
                $subTotal;
            } else {
                $subTotal = $subTotal + 9.95;
            }

            if (!$couponCode) {
                return response()->json([
                    'message' => 'not found',
                    'class' => 'red',
                    'total' => $subTotal
                ]);
            }

            if ($couponCode) {
                if ($couponCode->expiry < now()) {
                    $error = "coupon is expired";

                    return response()->json([
                        'message' => 'Coupon is Expired',
                        'class' => 'red',
                        'total' => $subTotal
                    ]);
                }
                if ($couponCode->status == 'active') {

                    if ($couponCode->remaining == 0) {
                        $error = "Coupon is used";

                        return response()->json([
                            'message' => 'Coupon is Used',
                            'class' => 'red',
                            'total' => $subTotal
                        ]);
                    } else {

                        $type = $couponCode->type;

                        if ($type == 'amount') {
                            return response()->json([
                                'message' => 'Applied Successfully',
                                'total' => $subTotal - $couponCode->discount,
                                'class' => 'green'
                            ]);
                        } else {
                            $discount =  $subTotal * $couponCode->discount / 100;
                            $total = $subTotal - $discount;
                            // dd($total);

                            return response()->json([
                                'message' => 'Applied Successfully',
                                'total' => $total,
                                'class' => 'green'
                            ]);
                        }
                    }
                } else {
                    return response()->json([
                        'message' => 'This Coupon Is Inactive',
                        'class' => 'red',
                        'total' => $subTotal
                    ]);
                }
            }
        }

        // return response()->json([
        //     'success' => false,
        //     'message' => 'not found'
        // ])
    }
}
