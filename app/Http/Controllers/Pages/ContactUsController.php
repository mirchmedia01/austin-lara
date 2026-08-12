<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ContactUsController extends Controller
{
    public function show(): View
    {
        return view('pages.contact-us', [
            'seoTitle' => 'Contact Austin Optics | Schedule Eye Care & Vision Support',
            'seoDescription' => 'Get in touch with Austin Optics for appointments, eye care services, and expert support for all your vision and eyewear needs in Forest Hills, Queens.',
        ]);
    }
}
