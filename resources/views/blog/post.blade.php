<x-layouts.wp page="single-post" :seoTitle="$seoTitle ?? null" :seoDescription="$seoDescription ?? null" :ogImage="$ogImage ?? null">

@push('styles')
<link rel="stylesheet" href="/wp-content/plugins/elementor-pro/assets/css/widget-posts.min.css">
@endpush

<main id="content" class="site-main post type-post status-publish format-standard has-post-thumbnail hentry">
    <div class="page-header">
        <h1 class="entry-title">{{ $post['title'] }}</h1>
    </div>

    <div class="page-content">
        @php
            $postHtml = (string) view('blog.posts.'.$post['slug'], ['post' => $post])->render();
        @endphp
        {!! \App\Support\WpContent::instance()->postContent($postHtml) !!}

        @include('blog.partials.contact')
    </div>
</main>

@if(count($recentPosts))
<section class="recent-posts" aria-label="Recent blog posts">
    <div class="e-con e-con-boxed e-con e-parent">
        <div class="e-con-inner">
            <h2 class="elementor-heading-title elementor-size-default">Keep Reading</h2>
            <div class="elementor-posts-container elementor-posts elementor-posts--skin-classic elementor-grid" role="list">
                @foreach ($recentPosts as $recent)
                    <x-blog-post-card :post="$recent" />
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

</x-layouts.wp>
