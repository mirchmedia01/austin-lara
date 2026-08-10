<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class FrameSelectionController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.frame-selection', [
            'seoTitle'       => 'Eyeglass Frames for Your Face Shape | Austin Optics Forest Hills, Queens NY',
            'seoDescription' => 'Find your perfect eyeglass frames at Austin Optics in Forest Hills, Queens. Expert help choosing frames to suit your face shape. Lafont, Silhouette, Chopard & more.',
        ]);
    }
}
