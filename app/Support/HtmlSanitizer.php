<?php

namespace App\Support;

/**
 * Minimal HTML sanitizer for rich-editor output.
 * Admin is trusted (session auth); this just strips active content so a
 * pasted snippet can't ship <script> / event handlers / javascript: URLs.
 */
class HtmlSanitizer
{
    public static function clean(?string $html): ?string
    {
        if ($html === null || trim($html) === '') {
            return null;
        }

        // Strip script/style/iframe/object/embed blocks entirely.
        $html = preg_replace('#<(script|style|iframe|object|embed|form|input|button)[^>]*?>.*?</\1\s*>#is', '', $html);
        $html = preg_replace('#<(script|style|iframe|object|embed|form|input|button)[^>]*?/?>#is', '', $html);

        // Allowlist of tags (no length limits on content).
        $allowed = '<p><br><h1><h2><h3><h4><ul><ol><li><blockquote><a><strong><b><em><i><u><img><figure><figcaption><hr><div><span><table><thead><tbody><tr><th><td>';
        $html = strip_tags($html, $allowed);

        // Strip event-handler attributes (onclick=... etc).
        $html = preg_replace('#\s+on\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)#i', '', $html);

        // Neutralize javascript:/data: URLs in href/src.
        $html = preg_replace_callback('#\s(href|src)\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)#i', function ($m) {
            $attr = strtolower($m[1]);
            $raw = trim($m[2], "\"'");
            if (preg_match('#^\s*(javascript|data|vbscript)\s*:#i', html_entity_decode($raw))) {
                return " {$attr}=\"#\"";
            }

            return $m[0];
        }, $html);

        return trim($html) === '' ? null : $html;
    }
}
