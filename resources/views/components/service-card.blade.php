@props(['icon' => '', 'title' => '', 'body' => '', 'route' => null, 'linkText' => 'Learn more'])

<article class="service-card">
    @if($icon)
    <div class="service-card__icon" aria-hidden="true">{{ $icon }}</div>
    @endif
    <h3 class="service-card__title">{{ $title }}</h3>
    <p class="service-card__body">{{ $body }}</p>
    @if($route)
    <a href="{{ route($route) }}" class="service-card__link">{{ $linkText }}</a>
    @endif
</article>
