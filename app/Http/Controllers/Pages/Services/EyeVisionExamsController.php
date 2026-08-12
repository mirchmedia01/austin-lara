<?php

namespace App\Http\Controllers\Pages\Services;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class EyeVisionExamsController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.services.eye-vision-exams', [
            'seoTitle' => 'Eye Exams in Forest Hills, Queens NY | Austin Optics',
            'seoDescription' => 'Austin Optics in Forest Hills Queens offers comprehensive eye and vision exams for children & adults with advanced diagnostic technology and expert care.',
        ]);
    }
}
