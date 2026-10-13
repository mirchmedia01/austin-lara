<?php

namespace App\Http\Controllers\Admin;

use App\Data\BlogPostRepository;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Support\HtmlSanitizer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(BlogPostRepository $repo)
    {
        $posts = BlogPost::query()->orderByDesc('published_at')->orderByDesc('id')->get();

        return view('admin.blog.index', [
            'posts' => $posts,
            'fallbackCount' => count($repo->fallbackPosts()),
            'seoTitle' => 'Blog Posts | Austin Optics Admin',
            'seoDescription' => 'Manage blog posts.',
        ]);
    }

    public function create()
    {
        return view('admin.blog.form', [
            'post' => null,
            'bodyHtml' => old('body_html', '<p>Start writing here...</p>'),
            'seoTitle' => 'New Post | Austin Optics Admin',
            'seoDescription' => 'Create a blog post.',
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $this->abortIfSlugConflicts($data);

        BlogPost::query()->create($this->payload($data));

        return redirect()->route('admin.blog.index')->with('status', 'Post created.');
    }

    public function edit(BlogPost $blog)
    {
        $bodyHtml = old('body_html', $blog->body_html ?? $this->legacyBody($blog));

        return view('admin.blog.form', [
            'post' => $blog,
            'bodyHtml' => $bodyHtml,
            'seoTitle' => 'Edit Post | Austin Optics Admin',
            'seoDescription' => 'Edit a blog post.',
        ]);
    }

    public function update(Request $request, BlogPost $blog)
    {
        $data = $this->validated($request);
        $this->abortIfSlugConflicts($data, $blog->id);

        $blog->update($this->payload($data));

        return redirect()->route('admin.blog.index')->with('status', 'Post updated.');
    }

    public function destroy(BlogPost $blog)
    {
        $blog->update(['is_public' => false]);

        return redirect()->route('admin.blog.index')->with('status', 'Post hidden.');
    }

    /**
     * Import the hardcoded catalog into MySQL so every post becomes editable.
     * Body stays linked to the legacy Blade view until first edit in the
     * rich editor (which then saves standalone HTML).
     */
    public function importExisting(BlogPostRepository $repo)
    {
        $imported = 0;
        $skipped = 0;

        foreach ($repo->fallbackPosts() as $fallback) {
            $slug = trim((string) ($fallback['slug'] ?? ''));
            if ($slug === '') {
                continue;
            }
            if (BlogPost::query()->where('slug', $slug)->exists()) {
                $skipped++;
                continue;
            }

            BlogPost::query()->create([
                'slug' => $slug,
                'title' => $fallback['title'],
                'excerpt' => $fallback['excerpt'] ?? null,
                'category' => $fallback['category'] ?? 'Eye Care & Vision',
                'date_label' => $fallback['date'] ?? null,
                'image' => $fallback['image'] ?? null,
                'image_alt' => $fallback['image_alt'] ?? null,
                'body_html' => null,
                'body_view' => $slug,
                'seo_title' => $fallback['seo_title'] ?? null,
                'seo_description' => $fallback['seo_desc'] ?? null,
                'is_public' => true,
            ]);
            $imported++;
        }

        return redirect()->route('admin.blog.index')->with(
            'status',
            "Imported {$imported} posts into MySQL ({$skipped} already existed)."
        );
    }

    /** Image upload for the rich editor + cover image field (local, volume-backed on Railway). */
    public function uploadImage(Request $request)
    {
        $data = $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $dir = public_path('uploads/blog');
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $name = Str::slug(pathinfo($data['image']->getClientOriginalName(), PATHINFO_FILENAME));
        $name = trim($name) !== '' ? $name : 'upload';
        $filename = $name.'-'.Str::random(8).'.'.$data['image']->extension();
        $data['image']->move($dir, $filename);

        return response()->json(['url' => '/uploads/blog/'.$filename]);
    }

    private function validated(Request $request): array
    {
        // No max lengths anywhere (same policy as SEO).
        return $request->validate([
            'title' => ['required', 'string'],
            'slug' => ['nullable', 'string'],
            'excerpt' => ['nullable', 'string'],
            'category' => ['nullable', 'string'],
            'date_label' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'image' => ['nullable', 'string'],
            'image_alt' => ['nullable', 'string'],
            'body_html' => ['required', 'string'],
            'seo_title' => ['nullable', 'string'],
            'seo_description' => ['nullable', 'string'],
            'is_public' => ['nullable', 'boolean'],
        ]);
    }

    private function payload(array $data): array
    {
        return [
            'slug' => Str::slug($data['slug'] ?: $data['title']),
            'title' => trim($data['title']),
            'excerpt' => trim((string) ($data['excerpt'] ?? '')) ?: null,
            'category' => trim((string) ($data['category'] ?? '')) ?: 'Eye Care & Vision',
            'date_label' => trim((string) ($data['date_label'] ?? '')) ?: null,
            'published_at' => $data['published_at'] ?? null,
            'image' => trim((string) ($data['image'] ?? '')) ?: null,
            'image_alt' => trim((string) ($data['image_alt'] ?? '')) ?: null,
            // Once edited, the post owns standalone HTML (legacy view no longer needed).
            'body_html' => HtmlSanitizer::clean($data['body_html']),
            'body_view' => null,
            'seo_title' => trim((string) ($data['seo_title'] ?? '')) ?: null,
            'seo_description' => trim((string) ($data['seo_description'] ?? '')) ?: null,
            'is_public' => (bool) ($data['is_public'] ?? false),
        ];
    }

    private function abortIfSlugConflicts(array $data, ?int $ignoreId = null): void
    {
        $slug = Str::slug($data['slug'] ?: $data['title']);
        $query = BlogPost::query()->where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        abort_if($query->exists(), 409, 'Slug already exists.');
    }

    /** Render the legacy Blade article so first-time edits start from real content. */
    private function legacyBody(BlogPost $blog): string
    {
        try {
            if ($blog->body_view && view()->exists('blog.posts.'.$blog->body_view)) {
                return (string) view('blog.posts.'.$blog->body_view, ['post' => $blog->toPostArray()])->render();
            }
        } catch (\Throwable) {
        }

        return '<p>Start writing here...</p>';
    }
}
