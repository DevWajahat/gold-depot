<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function checkCoupon($couponCode)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return $this->response('Cart is empty', 'red', 0);
        }

        $subTotal = $this->calculateSubtotal($cart);
        $subTotal = $this->applyDeliveryFee($subTotal);

        $coupon = $this->getCoupon($couponCode);

        if (!$coupon) {
            return $this->response('Coupon not found', 'red', $subTotal);
        }

        if ($this->isExpired($coupon)) {
            return $this->response('Coupon is expired', 'red', $subTotal);
        }

        if (!$this->isActive($coupon)) {
            return $this->response('This coupon is inactive', 'red', $subTotal);
        }

        if (!$this->hasRemaining($coupon)) {
            return $this->response('Coupon is used', 'red', $subTotal);
        }

        $discountedTotal = $this->applyDiscount($coupon, $subTotal);

        return $this->response('Applied successfully', 'green', $discountedTotal);
    }

    protected function calculateSubtotal($cart)
    {
        return $cart['sub_total'];
    }

    protected function applyDeliveryFee($subTotal)
    {
        return $subTotal > 199 ? $subTotal : $subTotal + 9.95;
    }

    protected function getCoupon($code)
    {
        return Coupon::where('coupon_code', $code)->first();
    }

    protected function isExpired($coupon)
    {
        return $coupon->expiry < now();
    }

    protected function isActive($coupon)
    {
        return $coupon->status === 'active';
    }

    protected function hasRemaining($coupon)
    {
        return $coupon->remaining > 0;
    }

    protected function applyDiscount($coupon, $subTotal)
    {
        if ($coupon->type === 'amount') {
            return $subTotal - $coupon->discount;
        }

        $discount = ($subTotal * $coupon->discount) / 100;
        return $subTotal - $discount;
    }

    protected function response($message, $class, $total)
    {
        return response()->json([
            'message' => $message,
            'class' => $class,
            'total' => $total
        ]);
    }
}
