<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Data\BlogPostRepository;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function __construct(private readonly BlogPostRepository $posts) {}

    public function index(): View
    {
        return view('blog.index', [
            'posts'          => $this->posts->allPosts(),
            'seoTitle'       => 'Eye Care Blog | Vision Tips & Guides for Forest Hills & Queens | Austin Optics',
            'seoDescription' => 'Read the Austin Optics blog for expert eye care tips, lens guides, contact lens advice, and vision health news for Forest Hills and Queens, NY patients.',
        ]);
    }
}
