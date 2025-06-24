<?php

namespace app\Filters;

use Closure;

class ProductPriceFilter
{

    public function handle($query, Closure $next)
    {
        if (request('price')) {
            if (request('price') == 'asc') {
                $query = $query->orderBy('price', 'asc');
            } else {
                $query = $query->orderBy('price', 'desc');
            }
        }


        return $next($query);
    }
}
