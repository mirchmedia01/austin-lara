@props(['page' => 'home', 'seoTitle' => null, 'seoDescription' => null, 'ogImage' => null])

@php
    $wp = \App\Support\WpContent::instance();
    $head = $wp->head($page, $seoTitle, $seoDescription, $ogImage);
    $bodyClass = $wp->bodyClass($page);
    $header = $wp->header($page);
    $footer = $wp->footer($page);
    $scripts = $wp->scripts($page);
@endphp
<!DOCTYPE html>
<html lang="en-US">
<head>
{!! $head !!}
<style>
.mobile-nav { display: none; }
.mobile-nav.is-open { display: flex; }
</style>
<link rel="stylesheet" href="{{ asset('css/mobile-nav.css') }}">
@stack('styles')
@include('partials.gtag')
</head>
<body class="{{ $bodyClass }}">

<a class="skip-link screen-reader-text" href="#content">Skip to content</a>

{!! $header !!}

{{-- Mobile Navigation Sidebar --}}
<x-mobile-nav />

{{ $slot }}

{!! $footer !!}

{!! $scripts !!}

<script src="{{ asset('js/app.js') }}" defer></script>
@stack('scripts')

</body>
</html>
