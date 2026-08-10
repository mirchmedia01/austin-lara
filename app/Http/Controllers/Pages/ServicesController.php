<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ServicesController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.services', [
            'seoTitle'       => 'Eye Care Services | Austin Optics Forest Hills Queens',
            'seoDescription' => 'Everything your eyes need under one roof. From a full eye health exam to contact lenses for the cases other opticians pass on. Austin Optics, Forest Hills Queens.',
        ]);
    }
}
