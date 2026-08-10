@props([
    'eyebrow'  => '',
    'heading'  => '',
    'lead'     => '',
    'stats'    => [],
    'breadcrumbs' => [],
])

<section class="page-hero" aria-labelledby="page-hero-heading">
    <div class="container">

        @if(count($breadcrumbs))
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            @foreach($breadcrumbs as $crumb)
                <span class="breadcrumb__sep" aria-hidden="true">/</span>
                @if($loop->last)
                    <span aria-current="page">{{ $crumb['label'] }}</span>
                @else
                    <a href="{{ route($crumb['route']) }}">{{ $crumb['label'] }}</a>
                @endif
            @endforeach
        </nav>
        @endif

        @if($eyebrow)
        <div class="page-hero__eyebrow">{{ $eyebrow }}</div>
        @endif

        <h1 id="page-hero-heading">{{ $heading }}</h1>

        @if($lead)
        <p class="page-hero__lead">{{ $lead }}</p>
        @endif

        @if(count($stats))
        <div class="page-hero__stats">
            @foreach($stats as $stat)
            <div>
                <div class="page-hero__stat-value">{{ $stat['value'] }}</div>
                <div class="page-hero__stat-label">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
        @endif

        {{ $slot ?? '' }}

    </div>
</section>
