<?php

namespace App\Http\Controllers\Blog;

use App\Data\BlogPostRepository;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function __construct(private readonly BlogPostRepository $posts) {}

    public function show(string $slug): View
    {
        $post = $this->posts->findBySlug($slug);

        if ($post === null) {
            abort(404);
        }

        $recentPosts = collect($this->posts->recentPosts(4))
            ->filter(fn ($p) => $p['slug'] !== $slug)
            ->take(3)
            ->values()
            ->all();

        return view('blog.post', [
            'post' => $post,
            'recentPosts' => $recentPosts,
            'seoTitle' => $post['seo_title'] ?? $post['title'],
            'seoDescription' => $post['seo_desc'] ?? $post['excerpt'],
            'ogImage' => $post['image'] ?? null,
        ]);
    }
}
