<?php

namespace App\Http\Controllers\Pages\Services;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ComputerVisionController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.services.computer-vision', [
            'seoTitle' => 'Computer Vision Solutions in Forest Hills, Queens | Austin Optics',
            'seoDescription' => 'Headaches, dry eyes, or blurry vision after screen time? Austin Optics in Forest Hills treats computer vision syndrome with custom lenses & blue light solutions.',
        ]);
    }
}
