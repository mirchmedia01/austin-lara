<?php

namespace App\Http\Controllers\Pages\Services;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class SunglassesController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.services.sunglasses', [
            'seoTitle' => 'Sunglasses in Forest Hills, Queens NY | Austin Optics',
            'seoDescription' => 'Austin Optics in Forest Hills carries Lafont, Silhouette, Chopard & Morel designer sunglasses — prescription lenses available. 100% cotton acetate frames.',
        ]);
    }
}
