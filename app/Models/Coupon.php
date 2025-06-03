<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['coupon_code', 'type', 'discount', 'max_usage', 'remaining', 'expiry', 'status'];
}
