<x-layouts.wp page="single-post" :seoTitle="$seoTitle ?? null" :seoDescription="$seoDescription ?? null" :ogImage="$ogImage ?? null">

@push('styles')
<link rel="stylesheet" href="{{ asset('css/blog-post.css') }}">
@endpush

@php
    $wp = \App\Support\WpContent::instance();
    $postHtml = (string) view('blog.posts.'.$post['slug'], ['post' => $post])->render();
    $bodyHtml = $wp->postContent($postHtml);
    $readTime = max(1, (int) ceil(str_word_count(strip_tags($bodyHtml)) / 200));
    $category = $post['category'] ?? 'Eye Care & Vision';
    $heroImage = isset($post['image']) ? $wp->postImage($post['image']) : null;
@endphp

<main id="content" class="ao-blog-single">

    <div class="ao-blog-wrap">

        {{-- Breadcrumb --}}
        <nav class="ao-blog-crumbs" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="ao-blog-crumbs__sep" aria-hidden="true">/</span>
            <a href="{{ route('blog') }}">Blog</a>
            <span class="ao-blog-crumbs__sep" aria-hidden="true">/</span>
            <span class="ao-blog-crumbs__current">{{ $post['title'] }}</span>
        </nav>

        {{-- Back to blog --}}
        <a class="ao-blog-back" href="{{ route('blog') }}">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
            Back to Blog
        </a>

        {{-- Article header --}}
        <header class="ao-post-header">
            <span class="ao-post-category" style="visibility:hidden" aria-hidden="true">{{ $category }}</span>
            <h1 class="ao-post-title">{{ $post['title'] }}</h1>
            <div class="ao-post-meta">
                <span>By <a href="{{ route('about-us') }}">Austin Optics</a></span>
                <span class="ao-post-meta__dot" aria-hidden="true">•</span>
                <span>{{ $post['date'] ?? '' }}</span>
                <span class="ao-post-meta__dot" aria-hidden="true">•</span>
                <span>{{ $readTime }} min read</span>
            </div>
        </header>

        {{-- Hero image --}}
        @if($heroImage)
        <figure class="ao-post-hero">
            <img src="{{ $heroImage }}" alt="{{ $post['image_alt'] ?? $post['title'] }}">
        </figure>
        @endif

        {{-- Article body --}}
        <article class="ao-post-content">
            {!! $bodyHtml !!}
        </article>

        @include('blog.partials.contact')

        {{-- Topics --}}
        <div class="ao-post-tags">
            <span class="ao-post-tags__label">Topics:</span>
            <a class="ao-post-tags__tag" href="{{ route('blog') }}">#{{ $category }}</a>
            <a class="ao-post-tags__tag" href="{{ route('blog') }}">#Austin Optics</a>
            <a class="ao-post-tags__tag" href="{{ route('contact-us') }}">#Forest Hills</a>
        </div>

        {{-- Author box --}}
        <aside class="ao-post-author" aria-label="About the author">
            <div class="ao-post-author__avatar" aria-hidden="true">AO</div>
            <div>
                <span class="ao-post-author__label">Written by</span>
                <h3 class="ao-post-author__name"><a href="{{ route('about-us') }}">Austin Optics</a></h3>
                <p class="ao-post-author__bio">Austin Optics is a full-service optical practice in Forest Hills, Queens, with more than 30 years of clinical expertise. Our team pairs comprehensive eye care with premium, hand-curated eyewear to help every patient see clearly.</p>
            </div>
        </aside>

    </div>
</main>

@if(count($recentPosts))
<section class="ao-related" aria-label="Related blog posts">
    <div class="ao-related__inner">
        <p class="ao-related__eyebrow">Keep Reading</p>
        <h2>More From the Austin Optics Blog</h2>
        <div class="ao-related__grid">
            @foreach ($recentPosts as $recent)
            <a class="ao-related-card" href="{{ route('blog.post', $recent['slug']) }}">
                @if(isset($recent['image']))
                <div class="ao-related-card__image">
                    <img src="{{ $wp->postImage($recent['image']) }}" alt="{{ $recent['image_alt'] ?? $recent['title'] }}" loading="lazy">
                </div>
                @endif
                <div class="ao-related-card__body">
                    <span class="ao-related-card__meta">{{ $recent['category'] ?? 'Eye Care & Vision' }}</span>
                    <h3 class="ao-related-card__title">{{ $recent['title'] }}</h3>
                    @if(isset($recent['excerpt']))
                    <p class="ao-related-card__excerpt">{{ $recent['excerpt'] }}</p>
                    @endif
                    <span class="ao-related-card__more">
                        Read Article
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

</x-layouts.wp>
