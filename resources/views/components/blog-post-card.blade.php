@props(['post' => []])

<article class="blog-card">
    @if(isset($post['image']))
    <div class="blog-card__image">
        <a href="{{ route('blog.post', $post['slug']) }}" tabindex="-1" aria-hidden="true">
            <img src="{{ asset($post['image']) }}"
                 alt="{{ $post['image_alt'] ?? $post['title'] }}"
                 loading="lazy">
        </a>
    </div>
    @endif
    <div class="blog-card__body">
        <p class="blog-card__meta">{{ $post['date'] ?? '' }}</p>
        <h3 class="blog-card__title">
            <a href="{{ route('blog.post', $post['slug']) }}">{{ $post['title'] }}</a>
        </h3>
        @if(isset($post['excerpt']))
        <p class="blog-card__excerpt">{{ $post['excerpt'] }}</p>
        @endif
        <a href="{{ route('blog.post', $post['slug']) }}" class="blog-card__read-more">
            Read more
        </a>
    </div>
</article>
