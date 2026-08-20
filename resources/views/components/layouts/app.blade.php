<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

    <title>{{ $seoTitle ?? config('seo.default_title') }}</title>
    <meta name="description" content="{{ $seoDescription ?? config('seo.default_description') }}">

    @if(isset($canonicalUrl))
    <link rel="canonical" href="{{ $canonicalUrl }}">
    @else
    <link rel="canonical" href="{{ url()->current() }}">
    @endif

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $seoTitle ?? config('seo.default_title') }}">
    <meta property="og:description" content="{{ $seoDescription ?? config('seo.default_description') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Austin Optics">
    <meta property="og:locale" content="en_US">
    @if(isset($ogImage))
    <meta property="og:image" content="{{ asset($ogImage) }}">
    @else
    <meta property="og:image" content="{{ asset('images/uploads/2026/05/Austin-optics-logo-white-scaled-2.png') }}">
    @endif

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/uploads/2026/05/Austin-optics-logo-white-scaled-2-150x150.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('images/uploads/2026/05/Austin-optics-logo-white-scaled-2.png') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Montserrat:wght@400;500;600;700;800&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    {{-- Font Awesome for icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwOg==" crossorigin="anonymous" referrerpolicy="no-referrer">

    {{-- Styles --}}
    <style>
    .mobile-nav { display: none; }
    .mobile-nav.is-open { display: flex; }
    </style>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')

    @include('partials.gtag')
</head>
<body>

    {{-- Announcement Bar --}}
    <x-announcement-bar />

    {{-- Site Header --}}
    <x-site-header />

    {{-- Mobile Navigation --}}
    <x-mobile-nav />

    {{-- Main Content --}}
    <main id="main-content">
        {{ $slot }}
    </main>

    {{-- Site Footer --}}
    <x-site-footer />

    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}" defer></script>

    @stack('scripts')

</body>
</html>
