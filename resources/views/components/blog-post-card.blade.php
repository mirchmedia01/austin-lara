@props(['post' => []])

<article class="elementor-post elementor-grid-item post type-post status-publish format-standard has-post-thumbnail hentry" role="listitem">
    @if(isset($post['image']))
    <a class="elementor-post__thumbnail__link" href="{{ route('blog.post', $post['slug']) }}" tabindex="-1">
        <div class="elementor-post__thumbnail">
            <img src="{{ \App\Support\WpContent::instance()->postImage($post['image']) }}"
                 alt="{{ $post['image_alt'] ?? $post['title'] }}"
                 class="attachment-medium size-medium"
                 loading="lazy">
        </div>
    </a>
    @endif
    <div class="elementor-post__text">
        <h3 class="elementor-post__title">
            <a href="{{ route('blog.post', $post['slug']) }}">{{ $post['title'] }}</a>
        </h3>
        <div class="elementor-post__meta-data">
            <span class="elementor-post-date">{{ $post['date'] ?? '' }}</span>
            <span class="elementor-post-avatar">No Comments</span>
        </div>
        @if(isset($post['excerpt']))
        <div class="elementor-post__excerpt">
            <p>{{ $post['excerpt'] }}</p>
        </div>
        @endif
        <a class="elementor-post__read-more" href="{{ route('blog.post', $post['slug']) }}">
            Read More »
        </a>
    </div>
</article>
