<?php

namespace App\Filters;
use Closure;

class ProductRangeFilter {
    public function handle($query, Closure $next)
    {

        if(request('range')){
            $query->whereBetween('price',request('range'));
        }

        return $next($query);
    }
}
