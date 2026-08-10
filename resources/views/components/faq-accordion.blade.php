@props(['faqs' => [], 'heading' => 'Frequently Asked Questions'])

<section class="section bg-body">
    <div class="container container--narrow">
        <h2 class="text-center" style="margin-bottom:var(--space-3xl);">{{ $heading }}</h2>
        <div class="faq-list" role="list">
            @foreach($faqs as $index => $faq)
            <div class="faq-item" role="listitem">
                <button class="faq-item__question"
                        aria-expanded="false"
                        aria-controls="faq-answer-{{ $index }}"
                        id="faq-question-{{ $index }}">
                    {{ $faq['question'] }}
                    <span class="faq-item__icon" aria-hidden="true">+</span>
                </button>
                <div class="faq-item__answer"
                     id="faq-answer-{{ $index }}"
                     role="region"
                     aria-labelledby="faq-question-{{ $index }}">
                    {!! $faq['answer'] !!}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
