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
/* Fallback dropdowns (Elementor menu JS chunks are not in the static copy) */
@media (hover: hover) {
  .elementor-nav-menu--main .menu-item-has-children:hover > ul.sub-menu { display: block !important; visibility: visible !important; opacity: 1 !important; }
}
.menu-item-has-children.ao-sub-open > ul.sub-menu { display: block !important; visibility: visible !important; opacity: 1 !important; }
nav.elementor-nav-menu--dropdown[data-ao-open="false"] { display: none !important; }
nav.elementor-nav-menu--dropdown[data-ao-open="true"] { display: block !important; }
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
<script>
// Fallback menu behavior (static copy has no Elementor menu JS):
// hamburger toggles the mobile nav, first tap on a dropdown parent opens
// the submenu, second tap follows the link.
(function () {
  document.querySelectorAll('.elementor-menu-toggle').forEach(function (toggle) {
    var scope = toggle.closest('.elementor-widget-nav-menu') || document;
    var nav = scope.querySelector('nav.elementor-nav-menu--dropdown');
    if (nav && nav.dataset.aoOpen === undefined) nav.dataset.aoOpen = 'false';
    toggle.addEventListener('click', function () {
      var open = nav && nav.dataset.aoOpen === 'true';
      if (nav) nav.dataset.aoOpen = open ? 'false' : 'true';
      toggle.setAttribute('aria-expanded', open ? 'false' : 'true');
    });
  });
  var touch = window.matchMedia('(hover: none)').matches;
  document.querySelectorAll('.menu-item-has-children > a').forEach(function (link) {
    link.addEventListener('click', function (e) {
      var li = link.parentElement;
      if (touch && !li.classList.contains('ao-sub-open')) {
        e.preventDefault();
        document.querySelectorAll('.menu-item-has-children.ao-sub-open').forEach(function (o) { o.classList.remove('ao-sub-open'); });
        li.classList.add('ao-sub-open');
      }
    });
  });
  document.addEventListener('click', function (e) {
    if (!e.target.closest('.menu-item-has-children')) {
      document.querySelectorAll('.menu-item-has-children.ao-sub-open').forEach(function (o) { o.classList.remove('ao-sub-open'); });
    }
  });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      document.querySelectorAll('.menu-item-has-children.ao-sub-open').forEach(function (o) { o.classList.remove('ao-sub-open'); });
    }
  });
})();
</script>
@stack('scripts')

</body>
</html>
