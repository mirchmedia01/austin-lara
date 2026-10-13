<?php

namespace App\Http\Controllers\Blog;

use App\Data\BlogPostRepository;
use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use App\Support\Seo;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function __construct(private readonly BlogPostRepository $posts) {}

    public function show(string $slug): View
    {
        $post = $this->posts->findBySlug($slug);

        // Hidden (unpublished in admin) posts are not publicly visible.
        if ($post === null || ($post['is_public'] ?? true) === false) {
            abort(404);
        }

        $recentPosts = collect($this->posts->recentPosts(4))
            ->filter(fn ($p) => $p['slug'] !== $slug)
            ->take(3)
            ->values()
            ->all();

        // DB override: per-post row in seo_settings (keyed by slug), auto-seeded from repo defaults.
        try {
            $row = SeoSetting::firstOrCreate(
                ['page_key' => 'post:'.$slug],
                ['label' => 'Post: '.$slug, 'seo_title' => $post['seo_title'] ?? $post['title'] ?? null, 'seo_description' => $post['seo_desc'] ?? $post['excerpt'] ?? null, 'og_image' => $post['image'] ?? null],
            );
            [$dbTitle, $dbDesc, $dbImage] = Seo::forPage('post:'.$slug, $post['seo_title'] ?? $post['title'], $post['seo_desc'] ?? $post['excerpt'], $post['image'] ?? null);
        } catch (\Throwable) {
            $dbTitle = $post['seo_title'] ?? $post['title'];
            $dbDesc = $post['seo_desc'] ?? $post['excerpt'];
            $dbImage = $post['image'] ?? null;
        }

        return view('blog.post', [
            'post' => $post,
            'recentPosts' => $recentPosts,
            'seoTitle' => $dbTitle,
            'seoDescription' => $dbDesc,
            'ogImage' => $dbImage,
        ]);
    }
}
