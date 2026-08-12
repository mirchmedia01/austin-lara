<?php

namespace App\Http\Controllers\Pages\Services;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class LensesController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.services.lenses', [
            'seoTitle' => 'Prescription Eyeglass Lenses in Forest Hills, Queens | Austin Optics',
            'seoDescription' => 'Austin Optics in Forest Hills, Queens offers progressive, bifocal, polarized, photochromic, and blue light prescription lenses with expert fittings.',
        ]);
    }
}
