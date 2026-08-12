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
@stack('styles')
</head>
<body class="{{ $bodyClass }}">

<a class="skip-link screen-reader-text" href="#content">Skip to content</a>

{!! $header !!}

{{ $slot }}

{!! $footer !!}

{!! $scripts !!}

</body>
</html>
