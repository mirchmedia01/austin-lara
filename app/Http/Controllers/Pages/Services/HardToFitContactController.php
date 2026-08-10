<?php

namespace App\Http\Controllers\Pages\Services;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HardToFitContactController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.services.hard-to-fit-contact', [
            'seoTitle'       => 'Hard to Fit Contact Lenses Forest Hills NY | Scleral & RGP Fittings',
            'seoDescription' => 'Austin Optics specializes in hard-to-fit contact lenses including scleral lenses, RGP lenses, and custom toric fittings for keratoconus and severe astigmatism.',
        ]);
    }
}
