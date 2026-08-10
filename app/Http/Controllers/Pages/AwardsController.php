<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AwardsController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.about.awards', [
            'seoTitle'       => 'Awards & Recognition | Austin Optics | Forest Hills, Queens NY',
            'seoDescription' => 'Austin Optics has earned recognition as one of Forest Hills and Queens\' premier eye care practices. See our awards and what they mean for our patients.',
        ]);
    }
}
