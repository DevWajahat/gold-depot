<?php

namespace App\Filters;

use Closure;

class ProductPriceFilter
{
    public function handle($query, Closure $next)
    {
        if (request('price')) {
            $query->orderBy('price', request('price') === 'asc' ? 'asc' : 'desc');
        }

        return $next($query);
    }
}
