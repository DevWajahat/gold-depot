<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Review extends Model
{

    protected $fillable = ['full_name', 'product_id','message','email','user_id'];

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function products() :BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
