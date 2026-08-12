<?php

namespace App\Http\Controllers\Pages;

use App\Data\BlogPostRepository;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(private readonly BlogPostRepository $blogPosts) {}

    public function __invoke(): View
    {
        return view('pages.home', [
            'recentPosts' => $this->blogPosts->recentPosts(3),
            'seoTitle' => 'Home - Austin Optics',
            'seoDescription' => 'The Optometrist Forest Hills Has Trusted Since 1999. Iris Alvarez has spent 30 years fitting glasses for New York\'s most particular patients. Expert eye care, contact lens exams, and premium eyewear in Forest Hills, Queens NY.',
        ]);
    }
}
