<?php

namespace app\Filters;

use Closure;
class ProductVariantFilter
{

    public function handle($query, Closure $next)
    {


        if(request('variants')){

            $query->whereHas('variants',function ($que) {
                $que->where('name',request('variants'));
            });
        }

        return $next($query);
    }
}
