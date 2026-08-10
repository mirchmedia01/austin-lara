<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AboutUsController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.about.about-us', [
            'seoTitle'       => 'About Austin Optics Eye Care Experts in Forest Hills, Queens NY',
            'seoDescription' => 'Austin Optics in Forest Hills, Queens offers eye exams, contact lens fittings and premium eyewear for families. Meet our team.',
        ]);
    }
}
