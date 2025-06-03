<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function applyCoupon($couponCode, $total)
    {


        $couponCode = Coupon::where('coupon_code', $couponCode)->first();


        if ($couponCode) {
            if ($couponCode->expiry < now()) {
                $error = "coupon is expired";

                return response()->json([
                    'message' => 'Coupon is Expired',
                    'class' => 'danger'
                ]);
            }
            if ($couponCode->status == 'active') {

                if ($couponCode->remaining == 0) {
                    $error = "Coupon is used";

                    return response()->json([
                        'message' => 'Coupon is Used',
                        'class' => 'danger'
                    ]);
                } else {
                    $message = "coupon is applied";


                    $couponCode->update([
                        'remaining' => $couponCode->remaining - 1
                    ]);

                    $type = $couponCode->type;

                    if ($type == 'amount') {

                        if (session()->has('cart') && count(session()->get('cart'))) {
                            foreach (session()->get('cart') as $id => $cart) {

                                $subTotal = $cart['price'] * $cart['quantity'];
                            }
                            $total = $subTotal - $couponCode->discount;
                            if ($subTotal > 199) {
                                return response()->json([
                                    'class' => 'success',
                                    'message' => 'Applied Successfully',
                                    'total' => $total,
                                    'shipping' => 'FREE SHIPPING',
                                    'couponCode' => $couponCode
                                ]);
                            }
                             else {
                                $subTotal + 9.95;
                                $wholePercent = $subTotal/100 * $cart['discount'];

                              $total =  $subTotal - $wholePercent;

                                return response()->json([
                                    'class' => 'success',
                                    'message' => 'Applied Successfully',
                                    'total' => $total,
                                    'shipping' => 'FREE SHIPPING',
                                    'couponCode' => $couponCode
                                ]);
                            }
                        }

                    }
                    else{
                          if (session()->has('cart') && count(session()->get('cart'))) {
                            foreach (session()->get('cart') as $id => $cart) {

                                $subTotal = $cart['price'] * $cart['quantity'];
                            }
                            $subTotal;
                            if ($subTotal > 199) {
                                return response()->json([
                                    'class' => 'success',
                                    'message' => 'Applied Successfully',
                                    'total' => $subTotal,
                                    'shipping' => 'FREE SHIPPING',
                                    'couponCode' => $couponCode
                                ]);
                            }
                             else {
                                return response()->json([
                                    'class' => 'success',
                                    'message' => 'Applied Successfully',
                                    'total' => $subTotal + 9.95,
                                    'shipping' => 'FREE SHIPPING',
                                    'couponCode' => $couponCode
                                ]);
                            }
                        }

                    return response()->json([
                        'success' => 'success',
                        'message' => 'Applied Successfully',
                        'couponCode' => $couponCode
                    ]);
                }
            }
        }

        // return response()->json([
        //     'success' => false,
        //     'message' => 'not found'
        // ]);
    }
}
}
