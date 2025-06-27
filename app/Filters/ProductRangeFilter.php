<?php

namespace App\Filters;

use Closure;

class ProductRangeFilter
{
    public function handle($query, Closure $next)
    {
        if (request('min_price') !== null && request('max_price') !== null) {
            $query->whereBetween('price', [
                (float) request('min_price'),
                (float) request('max_price')
            ]);
        }

        return $next($query);
    }
}
