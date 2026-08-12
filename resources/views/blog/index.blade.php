<x-layouts.wp page="blog" :seoTitle="$seoTitle ?? null" :seoDescription="$seoDescription ?? null">

    @php $blogParts = \App\Support\WpContent::instance()->blogMainParts(); @endphp

    {!! $blogParts['before'] !!}

    @foreach ($posts as $post)
        <x-blog-post-card :post="$post" />
    @endforeach

    {!! $blogParts['after'] !!}

</x-layouts.wp>
