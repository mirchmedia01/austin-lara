<?php

namespace App\Http\Controllers\Pages\Services;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ContactLensExamsController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.services.contact-lens-exams', [
            'seoTitle'       => 'Contact Lens Exams Forest Hills Queens NY | Austin Optics',
            'seoDescription' => 'Austin Optics provides contact lens exams and custom fittings for daily, monthly, toric, and multifocal lenses in Forest Hills, Queens. New patients welcome.',
        ]);
    }
}
