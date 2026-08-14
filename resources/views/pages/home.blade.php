<x-layouts.wp page="home">

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    @endpush

    @push('scripts')
        <script src="{{ asset('js/home.js') }}"></script>
    @endpush

    {!! \App\Support\WpContent::instance()->main('home') !!}
</x-layouts.wp>
