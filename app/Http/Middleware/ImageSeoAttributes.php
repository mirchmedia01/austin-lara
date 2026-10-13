<?php

namespace App\Http\Middleware;

use App\Support\WpContent;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Guarantees every rendered <img> carries alt + title (derived from the
 * filename when the markup omits them) so SEO checkers stay green.
 * Only touches successful HTML pages; skips admin, feeds and assets.
 */
class ImageSeoAttributes
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! $response->isSuccessful()) {
            return $response;
        }

        if ($request->is('admin*', 'up', 'sitemap.xml', 'robots.txt')) {
            return $response;
        }

        if (! str_contains((string) $response->headers->get('Content-Type'), 'text/html')) {
            return $response;
        }

        $content = $response->getContent();
        if (! is_string($content) || $content === '') {
            return $response;
        }

        $response->setContent(WpContent::instance()->addImageAttributes($content));

        return $response;
    }
}
