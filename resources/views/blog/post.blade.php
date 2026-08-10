<x-layouts.wp page="single-post" :seoTitle="$seoTitle" :seoDescription="$seoDescription" :ogImage="$ogImage ?? null">

<main id="content" class="site-main post type-post status-publish format-standard hentry">
    <div class="page-header">
        <h1 class="entry-title">{{ $post['title'] }}</h1>
    </div>

    <div class="page-content">
        {!! \App\Support\WpContent::instance()->postContent($post['content']) !!}
    </div>

    <div class="post-tags">
        <span class="tag-links">Tagged <a href="{{ route('blog') }}" rel="tag">Austin Optics</a></span>
    </div>
</main>

</x-layouts.wp>
