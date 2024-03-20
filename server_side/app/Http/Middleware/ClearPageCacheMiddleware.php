<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class ClearPageCacheMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $this->clearPageCache();
        return $response;
    }

    protected function clearPageCache()
    {
        $url = request()->url();
        $cacheKey = 'page_cache_' . md5($url);
        Cache::forget($cacheKey);
    }
}
