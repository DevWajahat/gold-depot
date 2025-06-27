<?php

namespace App\Filters;

use Closure;

class ProductDateFilter
{
    public function handle($query, Closure $next)
    {
        if (request('date')) {
            $query->orderBy('created_at', request('date') === 'asc' ? 'asc' : 'desc');
        }

        return $next($query);
    }
}
