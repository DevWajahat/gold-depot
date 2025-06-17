<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,'order_product','order_id','product_id')->withPivot('quantity','price','total_price','product_name','category','id')->withTimestamps();
    }

    protected $fillable = ['user_id','sub_total','shipping','total_amount','full_name','city','country','address','zip_code','phone','status','state','coupon_code','discount'];
}
