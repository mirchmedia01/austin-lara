<?php

namespace App\Support;

use Illuminate\Routing\UrlGenerator;

class TrailingSlashUrlGenerator extends UrlGenerator
{
    public function format($root, $path, $route = null)
    {
        $path = '/'.trim($path, '/');

        if ($this->formatHostUsing) {
            $root = call_user_func($this->formatHostUsing, $root, $route);
        }

        if ($this->formatPathUsing) {
            $path = call_user_func($this->formatPathUsing, $path, $route);
        }

        if ($path !== '/' && ! str_contains(basename($path), '.')) {
            $path = rtrim($path, '/').'/';
        }

        return trim($root, '/').$path;
    }
}
