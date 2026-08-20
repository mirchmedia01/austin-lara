<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class InsurancesController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.insurances', [
            'seoTitle' => 'Vision Insurance Accepted | Davis Vision & Medicare | Austin Optics Forest Hills',
            'seoDescription' => 'Austin Optics in Forest Hills accepts Davis Vision, Medicare & MetLife. Call (718) 261-8655 to verify your plan.',
        ]);
    }
}
