<?php

namespace app\Filters;

use Closure;

class ProductDateFilter
{

    public function handle($query, Closure $next)
    {

        if (request('date')) {


            if (request('date') == 'asc') {
                $query = $query->orderBy('created_at', 'asc');
            } else {
                $query = $query->orderBy('created_at', 'desc');
            }
        }

        return $next($query);
    }
}
