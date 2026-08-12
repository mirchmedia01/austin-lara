<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class BestOfBoroController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.about.best-of-boro', [
            'seoTitle' => 'Best of Boro Award | Austin Optics Forest Hills Queens',
            'seoDescription' => 'Austin Optics won the Four Leaf Best of the Boro Award 2026 in the Health & Wellness — Eyewear Store category. Serving Forest Hills, Queens since 1999.',
        ]);
    }
}
