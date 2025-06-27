<?php

namespace App\Filters;

use Closure;

class ProductVariantFilter
{
    public function handle($query, Closure $next)
    {
        if (request('variants')) {
            $variants = is_array(request('variants')) ? request('variants') : json_decode(request('variants'), true);
            if (!empty($variants)) {
                $query->whereHas('variants', function ($q) use ($variants) {
                    $q->whereIn('name', $variants);
                });
            }
        }

        return $next($query);
    }
}
