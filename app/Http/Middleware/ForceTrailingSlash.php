<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Redirects every public GET/HEAD request that lacks a trailing slash to its
 * canonical trailing-slash URL (301). The root path, Laravel health check and
 * paths that carry a file extension (assets, sitemap.xml) are left untouched.
 */
class ForceTrailingSlash
{
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->getPathInfo();

        if ($request->isMethod('GET') || $request->isMethod('HEAD')) {
            if (
                $path !== '/'
                && $path !== '/up'
                && ! str_ends_with($path, '/')
                && ! str_contains(basename($path), '.')
            ) {
                $query = $request->getQueryString();

                return redirect($path.'/'.($query ? '?'.$query : ''), 301);
            }
        }

        return $next($request);
    }
}
