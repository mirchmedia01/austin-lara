<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LegacyRedirectController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $path = '/'.trim($request->path(), '/').'/';

        $destination = config('redirects')[$path] ?? null;

        if ($destination === null) {
            abort(404);
        }

        return redirect($destination, 301);
    }
}
