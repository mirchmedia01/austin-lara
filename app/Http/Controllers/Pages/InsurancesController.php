<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class InsurancesController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.insurances', [
            'seoTitle'       => 'Vision Insurance Accepted | VSP, EyeMed & Davis Vision | Austin Optics Forest Hills',
            'seoDescription' => 'Austin Optics in Forest Hills accepts VSP, EyeMed, Davis Vision, Medicare, Cigna & MetLife. Call (718) 261-8655 to verify your plan.',
        ]);
    }
}
